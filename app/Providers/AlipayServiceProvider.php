<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Payment\Alipay;

class AlipayServiceProvider extends ServiceProvider
{

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('alipay', function () {
            return new Alipay();
        });

    }
}
