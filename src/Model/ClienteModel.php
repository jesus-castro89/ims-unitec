<?php


namespace App\Model;


use App\Cliente;
use App\ClienteQuery;
use App\Form\ClienteForm;
use Propel\Runtime\ActiveQuery\Criteria;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Validator\Validation;

class ClienteModel extends AbstractModel
{
    /**
     * ClienteModel constructor.
     */
    public function __construct()
    {
        $this->query = new ClienteQuery();
    }

    public function getForm(ContainerInterface $container, ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $req = Request::createFromGlobals();
        $object = $this->findOneByPrimaryKey("CodigoCliente");
        $form = $this->configureForm(ClienteForm::class, $object);
        // Procesar Formulario
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            if ($data->getCodigoCliente() != null) {
                $data->setNew(false);
            }
            $data->save();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $resp = new RedirectResponse($routeParser->urlFor('clienteDashboard'));
            $resp->prepare($req);
            return $resp->send();
        }
        // Renderizar formulario
        try {
            return $container->get('view')->render($response, 'clienteForm.twig', [
                'form' => $form->createView()
            ]);
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return $response;
        }
    }

    public function tableLoader(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $search = $args['search'] ?? null;
        $limit = $args['limit'] ?? null;
        $offset = $args['offset'] ?? null;
        if (is_null($limit) || is_null($offset)) {

            return $response;
        }
        $router = RouteContext::fromRequest($request)->getRouteParser();
        $next = $router->fullUrlFor($request->getUri(), "clienteTable") . "/$limit/" . ($offset + $limit);
        $previous = $offset == 0 ? null : $router->fullUrlFor($request->getUri(), "clienteTable") . "/$limit/" . ($offset - $limit);
        if (!is_null($search)) {
            $count = $this->query->filterByNombreCliente("%" . $search . "%", Criteria::LIKE)->count();
            $data = $this->query->filterByNombreCliente("%" . $search . "%", Criteria::LIKE)->limit($limit)->offset($offset);
        } else {
            $count = $this->query->find()->count();
            $data = $this->query->limit($limit)->offset($offset);
        }
        $output = [
            'count' => $count,
            'next' => $next,
            'previous' => $previous
        ];
        foreach ($data as $cliente) {

            $output['results'][] = [
                'edit' => "<a class='btn btn-primary edit-cliente' cliente='" . $cliente->getCodigoCliente() . "'>" .
                    "<i class='cil-pencil pe-2'></i>Editar</a>",
                'name' => $cliente->getNombreCliente(),
                'limite' => $cliente->getLimiteCredito(),
                'pais' => $cliente->getPais()
            ];
        }
        $response->getBody()->write(json_encode($output));
        return $response->withHeader("Content-Type", "application/json");
    }
}
