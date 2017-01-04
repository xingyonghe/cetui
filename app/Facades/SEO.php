<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SEO extends Facade{
    /*
    |--------------------------------------------------------------------------
    | SEO Facade
    | @author xingyonghe
    | @date 2016-11-22
    |--------------------------------------------------------------------------
    |
    | Seo门面（门面：是一种作为服务容器中的底层类的“静态代理"）
    |
    */
    protected static function getFacadeAccessor(){
        return 'seo';
    }
}
