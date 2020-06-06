<?php

require __DIR__.'/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as Psr7Response;
use Slim\Factory\AppFactory;

//phpinfo();
var_dump('Hello world, test, test');

var_dump(getenv('DATABASE_URL'));

$app = AppFactory::create();

$app->run();