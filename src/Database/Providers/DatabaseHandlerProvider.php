<?php

namespace Porous\Database\Providers;

use Porous\Database\Connectors\ConnectorFactory;
use League\Container\ServiceProvider;

class DatabaseHandlerProvider extends ServiceProvider
{
    protected $provides = [
        'dbh'
    ];

    public function register()
    {
        $config = $this->getContainer()->get('app')->getConfig('database');

        $factory = new ConnectorFactory();
        $connector = $factory->make($config['driver']);
        $connection = $connector->connect($config);

        $this->getContainer()->singleton('dbh', $connection);
    }
}