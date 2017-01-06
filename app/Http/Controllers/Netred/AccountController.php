<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
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
        SEO::setTitle('我的账户-网红中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.account.index');
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
        SEO::setTitle('账户管理-网红中心-'.configs('WEB_SITE_TITLE'));
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
        SEO::setTitle('添加账户-网红中心-'.configs('WEB_SITE_TITLE'));
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
        SEO::setTitle('修改账户-网红中心-'.configs('WEB_SITE_TITLE'));
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
    public function destroy(int $id){
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
        $my_bank = UserAccount::getUserAccount()->pluck('account','id');
        SEO::setTitle('提现申请-网红中心-'.configs('WEB_SITE_TITLE'));
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
            'money' => 'required',
            'code'  => 'required',
        ];
        $msgs = [
            'money.required' => '请填写你要提现的金额',
            'code.required'  => '请填写动态手机验证码',
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
     * 收支记录
     * @author: xingyonghe
     * @date: 2016-11-24
     */
    public function records(){
        $lists = D('UserAccount')
            ->where('userid',auth()->id())
            ->where('status',D('UserAccount')::STATUS_1)
            ->orderBy('crteated_at','desc')
            ->paginate(10);
        $this->intToString($lists,array(
            'type' => D('UserAccount')::TYPE_TEXT,
        ));
        SEO::setTitle('收支记录-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('member.account.records',compact('lists'));
    }

    /**
     * 提现记录（暂时未做）
     * @author: xingyonghe
     * @date: 2016-11-24
     */
    public function notes(){
        $lists = D('UserAccount')
            ->where('userid',auth()->id())
            ->where('status',D('UserAccount')::STATUS_1)
            ->orderBy('crteated_at','desc')
            ->paginate(C('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,array(
            'type' => D('UserAccount')::TYPE_TEXT,
        ));
        SEO::setTitle(C('WEB_SITE_TITLE').'-会员中心-提现记录');
        return view('member.account.notes',compact('lists'));
    }

    /**
     * 充值界面/账户充值
     * @author: xingyonghe
     * @date: 2016-11-23
     */
    public function recharge(){
        if(request()->method() == 'POST'){
            $data = request()->all();
            $rules = [
                'money'   => 'required|money',
                'payment' => 'required',
            ];
            $msgs = [
                'money.required'  => '请输入要充值的金额',
                'money.money'     => '金额格式错误',
                'payment.required'=> '请选择支付平台',
            ];
            $validator = validator()->make($data,$rules,$msgs);
            if ($validator->fails()) {
                return $this->ajaxValidator($validator);
            }
            $mark = '用户充值，充值金额：'.$data['money'];
            $resualt = D('UserAccount')->accountLog(
                $data['money'],
                D('UserAccount')::TYPE_1,
                request()->ip(),
                D('UserAccount')::STATUS_0,
                $mark
            );
            if($resualt === false){
                return $this->ajaxReturn('充值失败');
            }
            return $this->ajaxReturn('正在跳转支付页面...',1,route('member.account.pay',[$resualt['order_id']]));
        }
        SEO::setTitle(C('WEB_SITE_TITLE').'-会员中心-账户充值');
        return view('member.account.recharge');
    }

    /**
     * 充值跳转支付宝
     * @author: xingyonghe
     * @date: 2016-11-24
     */
    public function pay(string $order_id){
        $info = D('UserAccount')->where('order_id',$order_id)->first();
        $data = [
            "notify_url"	   => route('member.account.notify'),
            "return_url"	   => route('member.account.return'),
            "out_trade_no"	   => $order_id,
            "subject"	       => '用户充值',
            "total_fee"	       => $info->money,
            "body"	           => '',
        ];
        Alipay::alipaySubmit($data);
    }

    /**
     * 同步返回支付结果
     * @author: xingyonghe
     * @date: 2016-11-24
     */
    public function return(){
        $data = request()->all();
        $resault = Alipay::verifyReturn($data);
        if($resault){
//            $out_trade_no = $data['out_trade_no'];
//            $info = D('UserAccount')->where('order_id',$out_trade_no)->first();
            redirect(route('member.account.index'));
        }else{
            echo "支付失败";
        }
    }

    /**
     * 异步返回支付结果
     * 需要两个条件：1，过滤登陆判断、2，该方法是post方法，从 CSRF 保护中排除该URL
     * @author: xingyonghe
     * @date: 2016-11-24
     */
    public function notify(){
        $data = request()->all();
        $resault = Alipay::verifyNotify($data);
        if($resault){
            $out_trade_no = $data['out_trade_no'];
            $reconds = D('UserAccount')->where('order_id',$out_trade_no)->first();
            $reconds->update(['status'=>1]);
        }
    }





}
