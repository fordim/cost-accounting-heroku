<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as Psr7Response;
use Slim\Factory\AppFactory;

use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

if (php_sapi_name() == 'cli-server') {
    if (preg_match('/\.(?:png|jpg|jpeg|gif|svg|css|js)$/', $_SERVER["REQUEST_URI"])) {
        return false;    // serve the requested resource as-is.
    }
}

$capsule = new Capsule;

var_dump('Hello world, test, test');

$capsule->addConnection([
    'url'    => getenv('DATABASE_URL'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$capsule->setAsGlobal();

$app = AppFactory::create();

var_dump(Capsule::table('users')->get());

echo "<img src='/img/tux.svg'>";

$app->run();