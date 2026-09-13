<?php 
use App\Controllers\HomeController;
use App\Controllers\ProductsController;
use League\Route\Router;

return function(Router $router){
    $router->get('/', [HomeController::class , 'index']);

    $router->get('/products', [ProductsController::class, 'index']);

    $router->get('/product/{id:number}', [ProductsController::class, 'show']);

    $router->get("product/new",[ProductsController::class, "create"]);

    $router->post("product/store",[ProductsController::class,"store"]);
};