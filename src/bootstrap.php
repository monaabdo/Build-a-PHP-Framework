<?php

declare(strict_types=1);

use Framework\Template\PlatesRender;
use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductsController;
use Doctrine\ORM\EntityManagerInterface;
use Framework\Template\Render;
use Framework\Template\RenderInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use League\Route\Strategy\ApplicationStrategy;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require dirname(__DIR__) . '/vendor/autoload.php';

$request = ServerRequest::fromGlobals();

$builder = new DI\ContainerBuilder;

$builder->addDefinitions([
    ResponseFactoryInterface::class => DI\create(HttpFactory::class),
    RenderInterface::class  => DI\create(PlatesRender::class),
    EntityManagerInterface::class => function(){
        $paths = [dirname(__DIR__)."/src/Entities"];
        $config = ORMsetup::createAttributeMetadataConfiguration($paths, true);
        $params = [
            "driver"   => "pdo_mysql",
            "host" => "127.0.0.1",
            "dbname" => "shop_db",
            "user" => "root",
            "password" => ""
        ];
        $connection =DriverManager::getConnection($params ,$config); 
        return new EntityManager($connection,$config);
    }
]);

$builder->useAttributes(true);
$container = $builder->build();

$router = new Router();

$strategy = new ApplicationStrategy();
$strategy->setContainer($container);
$router->setStrategy($strategy);



$router->get('/', [HomeController::class , 'index']);

$router->get('/products', [ProductsController::class, 'index']);

$router->get('/product/{id:number}', [ProductsController::class, 'show']);

$router->get("product/new",[ProductsController::class, "create"]);

$router->post("product/store",[ProductsController::class,"store"]);

$response = $router->dispatch($request);

$emitter = new SapiEmitter();

$emitter->emit($response);