<?php

namespace Edmarr2\D4sign\Providers;

use Edmarr2\D4sign\Services\D4sign;
use Illuminate\Support\ServiceProvider;

class D4SignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/d4sign.php',
            'd4sign'
        );

        $this->app->bind('D4Sign', D4sign::class);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/d4sign.php' => config_path('d4sign.php'),
        ], 'd4sign-config');
    }
}
