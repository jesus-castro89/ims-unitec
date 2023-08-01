<?php


namespace App\Controller;


use App\Model\ClienteModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ClienteController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new ClienteModel();
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->loadDashboard("cliente.twig", $request, $response);
    }

    public function filterByCodigoClienteAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->filterByPrimaryKey("CodigoCliente", $request, $response, $args);
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // TODO: Implement filterByPrimaryKeyAction() method.
    }
}
