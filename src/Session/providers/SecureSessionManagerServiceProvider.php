<?php

namespace Porous\Session\Providers;

use League\Container\ServiceProvider;
use Porous\Session\Handlers\File\SecureFileSessionHandler;

class SecureSessionManagerServiceProvider extends ServiceProvider
{
    protected $provides = [
        'SessionHandlerInterface',
        'session'
    ];

    public function register()
    {
        $config = $this->getContainer()->get('app')->getConfig('session');

        $this->getContainer()->singleton('SessionHandlerInterface', function () use ($config) {
            return new SecureFileSessionHandler($this->getContainer()->get('Porous\Cryptography\EncryptInterface'), $config);
        });

        $this->getContainer()->singleton('session', 'Porous\Session\Managers\SecureSessionManager')
            ->withArgument('SessionHandlerInterface')
            ->withArgument($config['manager']);
    }
}