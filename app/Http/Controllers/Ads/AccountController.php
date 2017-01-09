<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use SEO;
use Alipay;
use Log;

class AccountController extends Controller
{

    protected $navkey = 'account';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }

    /**
     * 我的账户
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function index()
    {
        SEO::setTitle('账户中心-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.account.index');
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
        SEO::setTitle(C('WEB_SITE_TITLE').'-会员中心-收支记录');
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
        SEO::setTitle('账户充值-会员中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.account.recharge');
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
