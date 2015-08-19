<?php

namespace Porous\Session\Providers;

use League\Container\ServiceProvider;
use Porous\Session\Handlers\File\BaseFileSessionHandler;

class BaseSessionManagerServiceProvider extends ServiceProvider
{
    protected $provides = [
        'SessionHandlerInterface',
        'session'
    ];

    public function register()
    {
        $this->getContainer()->singleton('SessionHandlerInterface', function () {
            return new BaseFileSessionHandler();
        });

        $this->getContainer()->singleton('session', 'Porous\Session\Managers\BaseSessionManager')
            ->withArgument('SessionHandlerInterface');
    }
}