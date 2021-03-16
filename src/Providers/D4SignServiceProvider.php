<?php

namespace Edmarr2\D4sign\Providers;

use Illuminate\Support\ServiceProvider;

class D4SignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/d4sign.php', 'd4sign'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/d4sign.php' => config_path('d4sign.php'),
        ], 'd4sign-config');
    }
}