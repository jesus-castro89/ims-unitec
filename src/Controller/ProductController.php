<?php


namespace App\Controller;


use App\Model\ProductModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new ProductModel();
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->loadDashboard("product.twig", $request, $response);
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->model->filterByPrimaryKey("Id", $request, $response, $args);
    }
}
