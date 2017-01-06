<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use SEO;

class RednetEnterController extends Controller
{


    protected $channel_id = 5;//设置导航选中标志
    public function __construct()
    {
        view()->share('channel_id',$this->channel_id);
    }


    public function index()
    {
        SEO::setTitle(configs('WEB_SITE_TITLE'));
        return view('home.enter.index');
    }



























}
