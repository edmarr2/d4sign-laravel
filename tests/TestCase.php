<?php

namespace Edmarr2\D4sign\Tests;
use Edmarr2\D4sign\Providers\D4SignServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * add the package provider
     *
     * @param  Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            D4SignServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('d4sign.base_uri');
        $app['config']->set('d4sign.TOKEN_API');
        $app['config']->set('d4sign.CRYPT_KEY.orderBy');
    }
}