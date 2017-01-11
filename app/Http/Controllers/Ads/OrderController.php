<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserAccountLog;
use App\Models\UserBespeak;
use SEO;

class OrderController extends Controller
{

    protected $navkey = 'order';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        //新增/编辑共享直播平台数据
//        view()->composer(['user.star.edit','user.star.add'],function($view){
//            $view->with('mediaType',parse_config_attr(C('USER_MEDIA_TYPE')));
//        });
    }

    /**
     * 预约订单
     * @author xingyonghe
     * @date 2016-1-7
     * @return
     */
    public function index(){
        $lists = Order::where('buy_user_id',auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>Order::STATUS_TEXT]);
        SEO::setTitle('预约订单-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.order.index',compact('lists'));
    }

    /**
     * 我的预约
     * @author xingyonghe
     * @date 2016-1-7
     */
    public function bespeak(){
        $lists = UserBespeak::where('user_ads_id',auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>UserBespeak::STATUS_TEXT]);
        SEO::setTitle('我的预约-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.order.bespeak',compact('lists'));
    }

    /**
     * 支付界面
     * @author xingyonghe
     * @date 2016-1-7
     * @return
     */
    public function pay(string $id){

        $order = Order::where('buy_user_id',auth()->id())
            ->where('order_sn',$id)
            ->where('type',Order::TYPE_1)
            ->where('status',Order::STATUS_1)
            ->first();
        if(empty($order)){
            echo '订单信息不存在';die;
        }
        SEO::setTitle('订单支付-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.order.pay',compact('order'));
    }

    /**
     * 确认凭证资料
     * @author xingyonghe
     * @date 2016-1-11
     * @param string $id
     */
    public function verify(string $id){
        $info = Order::where('buy_user_id',auth()->id())
            ->where('order_sn',$id)
            ->where('status',Order::STATUS_3)
            ->first();
        if(empty($info)){
            $this->ajaxReturn('非法操作');
        }
        $view = view('ads.order.verify',compact('info'));
        return $this->ajaxReturn($view->render(),0,'','审核凭证资料');
    }

    /**
     * 通过凭证资料
     * @author xingyonghe
     * @date 2016-1-11
     */
    public function agreement(){
        $data =request()->all();
        $info = Order::where('order_sn',$data['order_sn'])
            ->where('buy_user_id',auth()->id())
            ->where('status',Order::STATUS_3)
            ->first();
        if(empty($info)){
            return $this->ajaxReturn('非法操作');
        }
        $resault = \DB::transaction(function () use($info){
            if(($info->update(['status'=>Order::STATUS_5])) && (User::where('id',$info['sell_user_id'])->increment('balance',$info['money']))){
                return true;
            }
        });
        if($resault){
            return $this->ajaxReturn('凭证资料验证成功',0,route('ads.order.index'));
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }

    /**
     * 拒绝凭证资料
     * @author xingyonghe
     * @date 2016-1-11
     */
    public function refuse(){
        $data =request()->all();
        $info = Order::where('order_sn',$data['order_sn'])
            ->where('buy_user_id',auth()->id())
            ->where('status',Order::STATUS_3)
            ->first();
        if(empty($info)){
            return $this->ajaxReturn('非法操作');
        }
        $resault = $info->update(['status'=>Order::STATUS_4]);
        if($resault){
            return $this->ajaxReturn('凭证资料验证失败，请等待客服处理...',0,route('ads.order.index'));
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }

    /**
     * 评分界面
     * @author xingyonghe
     * @date 2016-1-11
     * @param string $id
     * @return
     */
    public function comment(string $id){
        $view = view('ads.order.comment',compact('id'));
        return $this->ajaxReturn($view->render(),0,'','订单评分');
    }

    /**
     * 评分
     * @author xingyonghe
     * @date 2016-1-11
     * @param string $id
     * @return
     */
    public function send(){
        $data =request()->all();
        $info = Order::where('order_sn',$data['order_sn'])
            ->where('buy_user_id',auth()->id())
            ->where('status',Order::STATUS_5)
            ->first();
        if(empty($info)){
            return $this->ajaxReturn('非法操作');
        }
        $resault = $info->update(['score'=>$data['score'],'status'=>Order::STATUS_6]);
        if($resault){
            return $this->ajaxReturn('评分成功...',0,route('ads.order.index'));
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }


}
