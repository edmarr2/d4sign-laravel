<?php

namespace Edmarr2\D4sign\Providers;

use Illuminate\Support\ServiceProvider;

class D4SingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/d4sing.php', 'd4sign'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/d4sing.php' => config_path('d4sign.php'),
        ], 'd4sign-config');
    }
}