<?php 
declare(strict_types=1);
namespace Framework\Controller;

use DI\Attribute\Inject;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Framework\Template\RenderInterface;
abstract class AbstractController{
    #[Inject]
    private ResponseFactoryInterface $factory;
    #[Inject]
    private RenderInterface $render;
    protected function render(string $template , array $data=[]) : ResponseInterface
    {
         $content = $this->render->render($template,$data);

        $stream = $this->factory->createStream($content);

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);
        
        return $response;
    }
    public function redirect(string $path):ResponseInterface
    {
        $response = $this->factory->createResponse(302);
        $response = $response->withHeader("Location",$path);
        return $response;
    }
}