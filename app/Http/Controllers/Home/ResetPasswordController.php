<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use SEO;

class ResetPasswordController extends Controller
{

    public function __construct()
    {

    }

    public function mobile()
    {
        SEO::setTitle('找回密码-'.C('WEB_SITE_TITLE'));
        return view('home.password.mobile');
    }

    public function email()
    {
        SEO::setTitle('找回密码-'.C('WEB_SITE_TITLE'));
        return view('home.password.email');
    }
}
