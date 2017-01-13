<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
class IndexController extends Controller
{

    /**
     * 首页
     * @author xingyonghe
     * @date 2016-11-10
     * @return mixed
     */
    public function index(){
        return view('admin.index.index');
    }
}
