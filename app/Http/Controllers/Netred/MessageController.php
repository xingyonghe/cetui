<?php

namespace App\Http\Controllers\Netred;

use App\Http\Controllers\Controller;
use SEO;

class MessageController  extends Controller
{

    protected $navkey = 'message';//菜单标识
    public function __construct(){
        view()->share('navkey',$this->navkey);//用于设置头部菜单高亮
    }

    /**
     * 列表
     * @author: xingyonghe
     * @date: 2017-1-6
     * @return mixed
     */
    public function index()
    {
        SEO::setTitle('消息中心-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.message.index');
    }

    /**
     * 首页
     * @author: xingyonghe
     * @date: 2017-1-6
     * @param $id
     */
    public function show(int $id)
    {
        SEO::setTitle('消息详情-网红中心'.configs('WEB_SITE_TITLE'));
        return view('netred.message.show');
    }





}
