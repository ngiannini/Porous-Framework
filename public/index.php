<?php

require __DIR__ .'/../vendor/autoload.php';

use Porous\Core\Application;

$app = new Application();

$app->bootstrap();

$app->get('/', function() use ($app) {
   $app->render('home');
});

$app->run();