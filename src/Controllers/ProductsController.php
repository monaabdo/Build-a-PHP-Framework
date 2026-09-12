<?php
declare(strict_types=1);

namespace App\Controllers;


use Framework\Controller\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsController extends AbstractController
{
    public function index() :ResponseInterface
    {
        
        return $this->render("ProductsView");
    }
    public function show(ServerRequestInterface $request , array $args) :ResponseInterface
    {
       return $this->render("showView",['id'=>$args['id']]);
    }
}