<?php
declare(strict_types=1);

namespace App\Controllers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Framework\Template\RenderInterface;
class ProductsController
{
    public function __construct(private ResponseFactoryInterface $factory, private RenderInterface $render)
    {

    }
    public function index() :ResponseInterface
    {
        
        $content = $this->render->render("ProductsView");
        $stream = $this->factory->createStream($content);

        $response = $this->factory->createResponse(200);
        $response = $response->withBody($stream);
        return $response;
    }
    public function show(ServerRequestInterface $request , array $args) :ResponseInterface
    {
        $content = $this->render->render("showView",['id'=>$args['id']]);

        $stream = $this->factory->createStream($content);

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);
        
        return $response;
    }
}