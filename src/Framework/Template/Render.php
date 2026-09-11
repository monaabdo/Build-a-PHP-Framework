<?php
declare(strict_types = 1);
namespace Framework\Template;
use Framework\Template\RenderInterface;
class Render implements RenderInterface{
    public function render(string $template, array $data = []):string{
        extract($data, EXTR_SKIP);
        ob_start();
        require (dirname(__DIR__,3)."/views/$template.php");
        return ob_get_clean();
    }
}