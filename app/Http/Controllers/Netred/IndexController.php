<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserTask;
use SEO;
use App\Models\Messages;

class IndexController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Index Controller
    | @author xingyonghe
    | @date 2016-11-23
    |--------------------------------------------------------------------------
    |
    | 网红中心首页
    |
    */
    protected $navkey = 'home';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }

    /**
     * 首页
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function index(){
        //最新活动
        $new_count = UserTask::where('status','>=',UserTask::STATUS_2)
            ->whereDate('created_at', date('Y-m-d',time()))
            ->count();
        //我参加的活动
//        $join_count =
        //进行中的活动
        $have_count = Order::where('status',Order::STATUS_2)
            ->where('sell_user_id', auth()->id())
            ->count();
        //已完成活动
        $finish_count = Order::where('status',Order::STATUS_3)
            ->where('sell_user_id', auth()->id())
            ->count();
        $messages = Messages::where('userid',auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(9)->get();
        SEO::setTitle('首页-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.index.index',compact('messages','new_count','new_count','have_count','finish_count'));
    }





}
