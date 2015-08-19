<?php

namespace Porous\Database\Providers;

use Porous\Database\Compilers\BaseCompiler;
use League\Container\ServiceProvider;

class BaseDatabaseProvider extends ServiceProvider
{
    protected $provides = [
        'db',
        'database'
    ];

    public function register()
    {
        $connection = $this->getContainer()->get('dbh');
        $compiler = new BaseCompiler();

        $this->getContainer()->add('db', 'Porous\Database\QueryBuilders\BaseQueryBuilder')
            ->withArgument($connection)
            ->withArgument($compiler);
    }
}