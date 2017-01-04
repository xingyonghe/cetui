<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Seo\SEO;

class SeoServiceProvider extends ServiceProvider{

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('seo', function () {
            return new SEO();
        });

    }
}
