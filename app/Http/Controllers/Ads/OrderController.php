<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
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

    public function index(){
//        $map = array(
//            ['userid',auth()->id()],
//            ['status','>',D('Media')::STATUS_LOCKED]
//        );
//        $order = 'created_at';
//        $sort = 'desc';
//        $limit = 3;
//        $lists = D('Media')->listing($map,$order,$sort,$limit);
//        int_to_string($lists,array(
//            'status' => array(-1=>'删除',0=>'锁定',1=>'正常',2=>'待审核',3=>'未通过'),
//        ));
        $lists = [];
        SEO::setTitle('订单列表-广告主中心-'.configs('WEB_SITE_TITLE'));
        return view('ads.order.index',compact('lists'));
    }

}
