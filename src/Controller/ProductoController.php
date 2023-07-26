<?php


namespace App\Controller;


use App\Model\ClienteModel;
use App\Model\ProductoModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductoController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new ProductoModel();
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->loadDashboard("producto.twig", $request, $response);
    }

    public function filterByCodigoProductoAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->filterByCodigoProducto($request, $response, $args);
    }
}
