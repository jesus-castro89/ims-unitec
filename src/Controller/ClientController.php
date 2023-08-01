<?php


namespace App\Controller;


use App\Model\ClientModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ClientController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new ClientModel();
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->loadDashboard("client.twig", $request, $response);
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->model->filterByPrimaryKey("ClientId", $request, $response, $args);
    }
}
