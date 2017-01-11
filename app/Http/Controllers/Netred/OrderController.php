<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\Order;
use SEO;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Order Controller
    | @author xingyonghe
    | @date 2016-12-21
    |--------------------------------------------------------------------------
    |
    | 网红订单
    |
    */
    protected $navkey = 'order';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
        //新增/编辑共享直播平台数据
//        view()->composer(['user.star.edit','user.star.add'],function($view){
//            $view->with('mediaType',parse_config_attr(C('USER_MEDIA_TYPE')));
//        });
    }

    /**
     * 订单列表
     * @author: xingyonghe
     * @date: 2016-12-21
     * @return
     */
    public function index(){
        $lists = Order::where('sell_user_id',auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(configs('SYSTEM_LIST_LIMIT') ?? 10);
        $this->intToString($lists,['status'=>Order::STATUS_TEXT]);
        SEO::setTitle('订单管理-网红中心-'.configs('WEB_SITE_TITLE'));
        return view('netred.order.index',compact('lists'));
    }

    /**
     * 上传凭证
     * @return
     */
    public function upload(string $id){
        $info = Order::where('order_sn',$id)
            ->where('sell_user_id',auth()->id())
            ->where('status',Order::STATUS_2)
            ->first();
        if(empty($info)){
            $this->ajaxReturn('非法操作');
        }
        $view = view('netred.order.upload',compact('id'));
        return $this->ajaxReturn($view->render(),0,'','上传凭证');
    }

    /**
     * 凭证资料提交
     * @author xingyonghe
     * @date 2016-1-7
     */
    public function post(){
        $data =request()->all();
        $info = Order::where('order_sn',$data['order_sn'])
            ->where('sell_user_id',auth()->id())
            ->where('status',Order::STATUS_2)
            ->first();
        if(empty($info)){
            return $this->ajaxReturn('非法操作');
        }
        $resault = $info->update(['images'=>$data['images'],'video_target'=>$data['video_target'],'status'=>Order::STATUS_3]);
        if($resault){
            return $this->ajaxReturn('上传凭证成功，请等待广告主确认...',0,route('netred.order.index'));
        }else{
            return $this->ajaxReturn('操作失败');
        }
    }






}
