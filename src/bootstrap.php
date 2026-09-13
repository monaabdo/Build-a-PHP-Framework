<?php

declare(strict_types=1);

use Dotenv\Dotenv;
use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use League\Route\Strategy\ApplicationStrategy;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

define("APP_ROOT",dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(APP_ROOT);
$dotenv->load();

$request = ServerRequest::fromGlobals();

$builder = new DI\ContainerBuilder;

$builder->addDefinitions(APP_ROOT."/config/definations.php");

$builder->useAttributes(true);
$container = $builder->build();

$router = new Router;
$routes = require (APP_ROOT."/config/routes.php");
$routes($router);

$strategy = new ApplicationStrategy();
$strategy->setContainer($container);
$router->setStrategy($strategy);


$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);