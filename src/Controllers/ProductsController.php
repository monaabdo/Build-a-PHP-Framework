<?php
declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductsController
{
    public function index() :ResponseInterface
    {
        $stream = Utils::streamFor("List Of Products");

        $response = new GuzzleResponse;

        $response = $response->withBody($stream);
        return $response;
    }
    public function show(ServerRequestInterface $request , array $args) :ResponseInterface
    {
        $id = $args["id"];

        $stream = Utils::streamFor("Show Product With ID : $id");

        $response = new GuzzleResponse;

        $response = $response->withBody($stream);
        
        return $response;
    }
}