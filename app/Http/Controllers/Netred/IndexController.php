<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
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
        $messages = Messages::where('userid',auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(9)->get();
        SEO::setTitle('首页-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.index.index',compact('messages'));
    }





}
