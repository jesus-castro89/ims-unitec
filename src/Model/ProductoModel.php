<?php


namespace App\Model;


use App\Base\Producto;
use App\Form\ClienteForm;
use App\Form\ProductoFormulario;
use App\ProductoQuery;
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

class ProductoModel extends AbstractModel
{
    protected ProductoQuery $query;

    /**
     * ClienteModel constructor.
     */
    public function __construct()
    {
        $this->query = new ProductoQuery();
    }

    public function getForm(ContainerInterface $container, ServerRequestInterface $request, ResponseInterface $response, array $args)
    {
        // Verificando si es un formulario de agregado o edición
        $req = Request::createFromGlobals();
        $object = $this->findOneByPrimaryKey("CodigoProducto");
        $form = $this->configureForm(ProductoFormulario::class, $object);
        // Procesar Formulario
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            if ($data->getCodigoProducto() != null) {
                $data->setNew(false);
            }
            $data->save();
            $routeParser = RouteContext::fromRequest($request)->getRouteParser();
            $resp = new RedirectResponse($routeParser->urlFor('productoDashboard'));
            $resp->prepare($req);
            return $resp->send();
        }
        // Renderizar formulario
        try {
            return $container->get('view')->render($response, 'productoForm.twig', [
                'form' => $form->createView()
            ]);
        } catch (NotFoundExceptionInterface | ContainerExceptionInterface $e) {
            return $response;
        }
    }
}
