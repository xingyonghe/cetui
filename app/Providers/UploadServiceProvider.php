<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Upload\Upload;

class UploadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->singleton('upload', function () {
            return new Upload();
        });

    }
}
