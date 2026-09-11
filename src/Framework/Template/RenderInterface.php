<?php
declare(strict_types=1);
namespace Framework\Template;
interface RenderInterface
{
    public function render(string $template, array $data = []) :string;
}