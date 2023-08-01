<?php

namespace App\Controller;

use Exception;
use GraphQL\GraphQL;
use Phoole\Cache\Cache;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheCodingMachine\GraphQLite\Context\Context;
use TheCodingMachine\GraphQLite\SchemaFactory;

class GraphQLController extends AbstractController
{

    protected $maxDepth;

    protected $introspection;

    public function __construct(ContainerInterface $container, int $maxDepth = 15, bool $introspection = true)
    {
        parent::__construct($container);
        $this->maxDepth = $maxDepth;
        $this->introspection = $introspection;
    }

    public function indexAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $factory = new SchemaFactory(new Cache(), $this->container);
        $factory->addControllerNamespace('App\\GraphQL\\Controllers\\')
            ->addTypeNamespace('App\\');
        $schema = $factory->createSchema();
        $input = $request->getParsedBody();
        $query = $input['query'];
        $variables = $input['variables'] ?? null;
        try {
            $result = GraphQL::executeQuery($schema, $query, null, new Context(), $variables);
            $response->getBody()->write(
                json_encode($result->toArray())
            );
        } catch (Exception $e) {
            echo($e->getTraceAsString());
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $response; // TODO: Implement dashboardAction() method.
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $response;// TODO: Implement filterByPrimaryKeyAction() method.
    }
}
