<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Models\UserAccountLog;
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
        $start_time = request()->get('start_time','');
        $end_time = request()->get('end_time','');
        $lists = UserAccountLog::where('userid',auth()->id())
            ->where('type',UserAccountLog::TYPE_1)
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
        $params = [
            'start_time' => $start_time,
            'end_time' => $end_time,
        ];
        SEO::setTitle('账户中心-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.account.index',compact('lists','params'));
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
            ];
            $msgs = [
                'money.required'  => '请输入要充值的金额',
                'money.money'     => '金额格式错误',
            ];
            $validator = validator()->make($data,$rules,$msgs);
            if ($validator->fails()) {
                return $this->ajaxValidator($validator);
            }
            $mark = '用户充值，充值金额：'.$data['money'];
            $resualt = UserAccountLog::accountLog(
                $data['money'],
                UserAccountLog::TYPE_1,
                request()->ip(),
                UserAccountLog::STATUS_0,
                $mark
            );
            if($resualt === false){
                return $this->ajaxReturn('充值失败');
            }
            return $this->ajaxReturn('正在跳转支付页面...',1,route('api.recharge.pay',[$resualt['order_id']]));
        }
        SEO::setTitle('账户充值-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.account.recharge');
    }





}
