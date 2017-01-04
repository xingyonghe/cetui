<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Alipay extends Facade{
    /*
    |--------------------------------------------------------------------------
    | Alipay Facade
    | @author xingyonghe
    | @date 2016-11-22
    |--------------------------------------------------------------------------
    |
    | Alipay门面（门面：是一种作为服务容器中的底层类的“静态代理"）
    |
    */
    protected static function getFacadeAccessor(){
        return 'alipay';
    }
}
