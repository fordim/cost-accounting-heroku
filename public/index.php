<?php

require __DIR__.'/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as Psr7Response;
use Slim\Factory\AppFactory;

//phpinfo();

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule->setAsGlobal();

$capsule = new Capsule;

var_dump('Hello world, test, test');

//var_dump(getenv('DATABASE_URL'));

$capsule->addConnection([
    'url'    => getenv('DATABASE_URL'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$capsule->setAsGlobal();

$app = AppFactory::create();

var_dump(Capsule::table('users')->get());

$app->run();