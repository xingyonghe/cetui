<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Upload extends Facade{
    /*
    |--------------------------------------------------------------------------
    | Upload Facade
    | @author xingyonghe
    | @date 2016-11-25
    |--------------------------------------------------------------------------
    |
    | Upload门面（门面：是一种作为服务容器中的底层类的“静态代理"）
    |
    */
    protected static function getFacadeAccessor(){
        return 'upload';
    }
}
