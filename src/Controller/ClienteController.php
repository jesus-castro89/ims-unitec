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
    private ClienteModel $model;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new ClienteModel();
    }

    public function formAction(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

        return $this->model->getForm($this->container, $request, $response, $args);
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            return $this->container->get('view')->render($response, 'cliente.twig', [

            ]);
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return $response;
        }
    }

    public function getAllAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->getAll($request, $response, $args);
    }

    public function tableAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->tableLoader($request, $response, $args);
    }

    public function filterByCodigoClienteAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->filterByCodigoCliente($request, $response, $args);
    }
}
