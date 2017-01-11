<?php

namespace App\Http\Controllers\Ads;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use SEO;

class IndexController extends Controller
{
    protected $navkey = 'home';//菜单标识
    public function __construct()
    {
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }

    /**
     * 首页
     * @author: xingyonghe
     * @date: 2016-11-23
     * @return mixed
     */
    public function index()
    {
        $messages = Messages::where('userid',auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(9)->get();
        SEO::setTitle('首页-广告主中心'.configs('WEB_SITE_TITLE'));
        return view('ads.index.index',compact('messages'));
    }





}
