<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Upload;

class UploadApiController extends Controller
{

    public function file()
    {

    }


    public function picture()
    {
        $files = request()->file();
        $disks = 'picture';//配置名称
        $info = Upload::picture($files,$disks);
        return response()->json($info);
    }

    public function logo()
    {
        $files = request()->file();
        $disks = 'picture';//配置名称
        $info = Upload::logo($files,$disks);
        return response()->json($info);
    }


























}
