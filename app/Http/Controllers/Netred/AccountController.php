<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Models\UserCashLog;
use App\Models\UserData;
use SEO;
use Alipay;
use App\Models\UserBank;

class AccountController extends Controller
{

    protected $navkey = 'account';//菜单标识
    public function __construct()
    {
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        view()->composer(['netred.account.index','netred.account.create','netred.account.cash','netred.account.account'],function($view){
            $view->with('bank',UserBank::getBank());//资源类型，活动投放类型关联这个
        });
    }

    /**
     * 我的账户
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function index()
    {
        $start_time = request()->get('start_time','');
        $end_time = request()->get('end_time','');
        $lists = UserCashLog::where('userid',auth()->id())
            ->where(function ($query) use($start_time,$end_time){
                if($start_time && $end_time){
                    $query->whereBetween('created_at', [$start_time, $end_time]);
                }else if($end_time){
                    $query->whereDate('created_at', $end_time);
                }else if($start_time){
                    $query->whereDate('created_at', $start_time);
                }
            })
            ->orderBy('created_at','desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,array(
            'status' => UserCashLog::STATUS_TEXT,
        ));
        $params = [
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
        SEO::setTitle('我的账户-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.index',compact('lists','params'));
    }

    /**
     * 账户管理
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function account()
    {
        $lists = UserAccount::getUserAccount();
        SEO::setTitle('账户管理-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.account',compact('lists'));
    }

    /**
     * 添加收款账户
     * @author: xingyonghe
     * @date: 2016-1-6
     * @return mixed
     */
    public function create()
    {
        SEO::setTitle('添加账户-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.create');
    }

    /**
     * 修改账户
     * @author: xingyonghe
     * @date: 2016-1-6
     * @return mixed
     */
    public function edit(int $id)
    {
        $info = UserAccount::where('userid',auth()->id())->findOrFail($id);
        SEO::setTitle('修改账户-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.create',compact('info'));
    }

    /**
     * 账户更新
     * @author xingyonghe
     * @date 2016-1-6
     * @return
     */
    public function update()
    {
        $data = request()->all();
        $rules = [
            'bank_id' => 'required',
            'account' => 'required',
            'deposit'  => 'required_unless:bank_id,1',
            'username' => 'required_unless:bank_id,1'
        ];
        $msgs = [
            'bank_id.required' => '请选择账户类型',
            'account.required' => '请填写账户信息',
            'deposit.required_unless'    => '请填写开户行信息',
            'username.required_unless'    => '请填写开户用户名称',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        $data['userid'] = auth()->id();
        $reault = UserAccount::updateData($data);
        if($reault){
            return $this->ajaxReturn(isset($data['id']) ? '账户信息修改成功':'账户信息添加成功',0,route('netred.account.account'));
        }else{
            return $this->ajaxReturn('账户信息操作失败');
        }
    }

    /**
     * 删除账户
     * @author: xingyonghe
     * @date: 2017-1-4
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        $resault = UserAccount::where('userid',auth()->id())->where('id',$id)->delete();
        if($resault){
            return $this->ajaxReturn('账户信息删除成功',0,route('netred.account.account'));
        }else{
            return $this->ajaxReturn('账户信息删除失败');
        }
    }

    /**
     * 提现申请
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function cash()
    {
        $info = UserData::where('userid',auth()->id())->first();
        if(empty($info)){
            return $this->errors('你还没有认证资料',url()->previous());
        }
        if($info['status'] == UserData::STATUS_VERIFY){
            return $this->errors('认证资料正在审核中，请耐心等待审核，您也可以主动联系专属客服跟进',url()->previous());
        }
        if($info['status'] == UserData::STATUS_FEILED){
            return $this->errors('认证资料审核失败',url()->previous());
        }
        $my_bank = UserAccount::getUserAccount()->pluck('account','id');
        SEO::setTitle('提现申请-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.cash',compact('my_bank'));
    }

    /**
     * 提现申请提交
     * @author xingyonghe
     * @date 2016-1-6
     * @return
     */
    public function post()
    {
        $data = request()->all();
        $rules = [
            'money'   => 'required|money',
            'account_id' => 'required',
            'payword' => 'required',
        ];
        $msgs = [
            'money.required' => '请填写你要提现的金额',
            'money.money'  => '金额格式错误',
            'account_id.required' => '请选择银行账户',
            'payword.required' => '请输入支付密码',
        ];
        $validator = validator()->make($data,$rules,$msgs);
        if ($validator->fails()) {
            return $this->ajaxValidator($validator);
        }
        if(empty(auth()->user()->payword)){
            return response()->json(['status'=>-1,'info'=>'支付密码未设置','id'=>'payword']);
        }
        if((\Hash::check($data['payword'], auth()->user()->payword)) === false){
            return response()->json(['status'=>-1,'info'=>'支付密码输入错误','id'=>'payword']);
        }
        if(auth()->user()->balance < $data['money']){
            return response()->json(['status'=>-1,'info'=>'余额不足','id'=>'money']);
        }
        $account = UserAccount::where('userid',auth()->id())->findOrFail($data['account_id']);
        $bank = UserBank::findOrFail($account['bank_id']);
        $log = [
            'money' => $data['money'],
            'ip' => request()->ip(),
            'account' => $account['account'],
            'account_type' => $bank['name']
        ];
        $reault = UserCashLog::cashLog($log);
        if($reault){
            return $this->ajaxReturn('申请提现成功',0,route('netred.account.index'));
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }

}
