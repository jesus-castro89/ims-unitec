<?php


namespace App\Model;


use App\CategoryQuery;
use App\Form\CategoryForm;
use Propel\Runtime\ActiveQuery\Criteria;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Routing\RouteContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class CategoryModel extends AbstractModel
{
    /**
     * ClienteModel constructor.
     */
    public function __construct()
    {
        $this->query = new CategoryQuery();
    }

    public function getForm(ContainerInterface $container, ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        $req = Request::createFromGlobals();
        $object = $this->findOneByPrimaryKey("Id");
        $form = $this->configureForm(CategoryForm::class, $object);
        // Procesar Formulario
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            print_r($data);
            if ($data->getId() != null) {
                $data->setNew(false);
            }
            $data->save();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $resp = new RedirectResponse($routeParser->urlFor('categoryDashboard'));
            $resp->prepare($req);
            return $resp->send();
        }
        // Renderizar formulario
        try {
            return $container->get('view')->render($response, 'categoryForm.twig', [
                'form' => $form->createView()
            ]);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
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
        $next = $router->fullUrlFor($request->getUri(), "categoryTable") . "/$limit/" . ($offset + $limit);
        $previous = $offset == 0 ? null : $router->fullUrlFor($request->getUri(), "categoryTable") . "/$limit/" . ($offset - $limit);
        if (!is_null($search)) {
            $count = $this->query->filterByName("%" . $search . "%", Criteria::LIKE)->count();
            $data = $this->query->filterByName("%" . $search . "%", Criteria::LIKE)->limit($limit)->offset($offset);
        } else {
            $count = $this->query->find()->count();
            $data = $this->query->limit($limit)->offset($offset);
        }
        $output = [
            'count' => $count,
            'next' => $next,
            'previous' => $previous
        ];
        foreach ($data as $category) {

            $output['results'][] = [
                'edit' => "<a class='btn btn-primary edit' entity='" . $category->getId() . "'>" .
                    "<i class='cil-pencil pe-2'></i>Editar</a>",
                'name' => $category->getName()
            ];
        }
        $response->getBody()->write(json_encode($output));
        return $response->withHeader("Content-Type", "application/json");
    }
}
