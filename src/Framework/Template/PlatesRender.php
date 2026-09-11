<?php 
declare(strict_types=1);
namespace Framework\Template;

use League\Plates\Engine;


class PlatesRender implements RenderInterface{
    public function render(string $template, array $data = []): string
    {
        $engine = new Engine(dirname(__DIR__,3)."/views");
        return $engine->render($template,$data);
    }
}