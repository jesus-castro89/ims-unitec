<?php


namespace App\Controller;


use App\Form\ClienteForm;
use App\Model\ClienteModel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;

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
}
