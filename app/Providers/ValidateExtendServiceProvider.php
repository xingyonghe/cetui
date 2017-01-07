<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidateExtendServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //金额
        Validator::extend('money',function ($attribute,$value,$parameters){
            return preg_match('/^\d+(\.\d+)?$/',$value);
        });
        //手机
        Validator::extend('mobile',function ($attribute,$value,$parameters){
            return preg_match('/^1[34578]{1}\d{9}$/',$value);
        });
        //正整数
        Validator::extend('positive',function ($attribute,$value,$parameters){
            return preg_match('/^\+?[1-9]\d*$/',$value);
        });
            //正整数
        Validator::extend('positive_integer',function ($attribute,$value,$parameters){
            return preg_match('/^\+?[1-9]\d*$/',$value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
