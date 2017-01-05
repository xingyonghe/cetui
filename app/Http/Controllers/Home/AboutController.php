<?php

namespace App\Http\Controllers\Home;

use SEO;

class AboutController extends CommonController{
    /*
    |--------------------------------------------------------------------------
    | About Controller
    | @author xingyonghe
    | @date 2016-11-14
    |--------------------------------------------------------------------------
    |
    | 前台关于我们控制器
    |
    */

    public function index(){
        SEO::setTitle(C('WEB_SITE_TITLE').'-关于我们');
        return view('home.about.index');
    }




























}
