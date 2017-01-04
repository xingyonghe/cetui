<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\MobileSms\SMS;

class SmsServiceProvider extends ServiceProvider
{

    public function boot()
    {

    }

    public function register()
    {
        $this->app->singleton('sms', function () {
            return new SMS();
        });

    }
}
