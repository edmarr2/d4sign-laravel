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
        $app['config']->set('d4sign.base_uri', 'http://demo.d4sign.com.br/api/v1/');
        $app['config']->set('d4sign.TOKEN_API', 'live_31c149f86b6fc843dc36a7f459ff238ca8cb7c534caba41e9b4a3154bcde7dfe');
        $app['config']->set('d4sign.CRYPT_KEY.orderBy', 'live_crypt_xVCUzsXUWaN0XL2TgSAWZo9UTES0u4DP');
    }
}