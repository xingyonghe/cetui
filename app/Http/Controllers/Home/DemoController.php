<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class DemoController extends Controller{


    public function file(){
        return view('home.demo.file');
    }

    public function picture(){
        $pconf = config('filesystems.disks.picture');
        return view('home.demo.avatar',compact('pconf'));
    }


























}
