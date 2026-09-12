<?php
declare(strict_types=1);

namespace App\Controllers;


use Framework\Controller\AbstractController;
use PDO;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Entities\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductsController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {
        
    }
    public function index() :ResponseInterface
    {
        
        $repo = $this->em->getRepository(Product::class);
        $products = $repo->findAll();
        return $this->render("ProductsView",["products" => $products]);
    }
    public function show(ServerRequestInterface $request , array $args) :ResponseInterface
    {
        $product = $this->em->find(Product::class, $args['id']);
       return $this->render("showView",['product'=> $product]);
    }
    public function create():ResponseInterface
    {
        return $this->render("CreateProduct");
    }
    public function store(ServerRequestInterface $request) :ResponseInterface
    {
        $params = $request->getParsedBody();
        $product = new Product;
        $product->setName($params["name"]);
        $product->setDescription($params["description"]);
        $product->setSize((int) $params["size"]);
        $this->em->persist($product);
        $this->em->flush();
        return $this->redirect("/product/{$product->getId()}");
    }
}