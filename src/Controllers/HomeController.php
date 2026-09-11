<?php
declare(strict_types=1);
namespace App\Controllers;

use Framework\Template\Render;
use Framework\Template\RenderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class HomeController
{
    public function __construct(private ResponseFactoryInterface $factory, private RenderInterface $render)
    {

    }
    public function index() :ResponseInterface
    {
        
        $content = $this->render->render("HomeView");
        $stream = $this->factory->createStream($content);

        $response = $this->factory->createResponse(200);
        $response = $response->withBody($stream);
        return $response;
    }
}