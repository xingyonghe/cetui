<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use SEO;

class AboutController extends Controller
{


    public function index(){
        SEO::setTitle(configs('WEB_SITE_TITLE').'-关于我们');
        return view('home.about.index');
    }




























}
