<?php

namespace Porous\Cookie\Providers;

use League\Container\ServiceProvider;
use Porous\Cookie\BaseCookieJar;

class BaseCookieJarServiceProvider extends ServiceProvider
{
    protected $provides = [
        'cookie'
    ];

    public function register()
    {
        $this->getContainer()->singleton('cookie', function () {
            $request = $this->getContainer()->get('request');
            $response = $this->getContainer()->get('response');
            return new BaseCookieJar($request, $response);
        });
    }
}