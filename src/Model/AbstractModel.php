<?php


namespace App\Model;


use App\Form\ProductoFormulario;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Validator\Validation;

abstract class AbstractModel
{
    protected function findOneByPrimaryKey($primaryKey)
    {
        $req = Request::createFromGlobals();
        $id = $req->get('id');
        if ($id != null) {

            $object = $this->query->create()->findOneBy($primaryKey, $id);
        } else {
            $object = null;
        }
        return $object;
    }

    public function filterByPrimaryKey($primaryKey, ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = $args['id'] ?? null;
        if (is_numeric($id)) {

            $client = $this->query->findOneBy($primaryKey, $id);
            if (!is_null($client)) {
                $response->getBody()->write(json_encode($client->toArray()));
                return $response->withHeader("Content-Type", "application/json");
            } else {
                $output = ["message" => "No Existe Cliente con el ID especificado"];
                $response->getBody()->write(json_encode($output));
                return $response->withStatus(404, "No existe el Cliente");
            }
        } else {
            $output = ["message" => "El valor del código de cliente no es un número"];
            $response->getBody()->write(json_encode($output));
            return $response->withStatus(405, "Código de Cliente en Formato Incorrecto");
        }
    }

    protected function configureForm($formClass, $object): FormInterface
    {

        // Crear usuario y llaves de seguridad
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new NativeSessionTokenStorage();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);
        $formFactory = Forms::createFormFactoryBuilder()->addExtension(new HttpFoundationExtension())
            ->addExtensions([
                new CsrfExtension($csrfManager),
                new ValidatorExtension(Validation::createValidator())
            ])->getFormFactory();
        return $formFactory->createBuilder($formClass, $object, array(
            'attr' => array(
                'id' => 'entry'
            )
        ))->getForm();
    }

    public function getAll(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $response->getBody()->write($this->query->find()->toJSON());
        return $response->withHeader("Content-Type", "application/json");
    }
}
