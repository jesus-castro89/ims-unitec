<?php

namespace App\Controller;

use Exception;
use GraphQL\Server\RequestError;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use GraphQL\Utils\BuildSchema;
use JetBrains\PhpStorm\Pure;
use JsonException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GraphQL\Executor\Executor;
use GraphQL\Type\Definition\ResolveInfo;

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
        $this->setResolvers(include dirname(__DIR__, 2) . '/src/GraphQL/resolvers.php');
        $schema = BuildSchema::build(file_get_contents(dirname(__DIR__, 2) . '/src/GraphQL/schema.graphqls'));
        $input = $request->getParsedBody();
        $query = $input['query'];
        $variables = $input['variables'] ?? null;
        $context = [];
        # Create server configuration
        $config = ServerConfig::create()
            ->setSchema($schema)
            ->setContext($context)
            ->setQueryBatching(true);
        # Allow GraphQL Server to handle the request and response
        $server = new StandardServer($config);
        try {
            $response = $server->processPsrRequest($request, $response, $response->getBody());
        } catch (RequestError | JsonException $e) {
        }
        return $response->withHeader('Content-Type', 'application/json');
    }

    private function setResolvers($resolvers)
    {
        Executor::setDefaultFieldResolver(function ($source, $args, $context, ResolveInfo $info) use ($resolvers) {
            $fieldName = $info->fieldName;

            if (is_null($fieldName)) {
                throw new Exception('Could not get $fieldName from ResolveInfo');
            }

            if (is_null($info->parentType)) {
                throw new Exception('Could not get $parentType from ResolveInfo');
            }

            $parentTypeName = $info->parentType->name;

            if (isset($resolvers[$parentTypeName])) {
                $resolver = $resolvers[$parentTypeName];

                if (is_array($resolver)) {
                    if (array_key_exists($fieldName, $resolver)) {
                        $value = $resolver[$fieldName];

                        return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                    }
                }

                if (is_object($resolver)) {
                    if (isset($resolver->{$fieldName})) {
                        $value = $resolver->{$fieldName};

                        return is_callable($value) ? $value($source, $args, $context, $info) : $value;
                    }
                }
            }

            return Executor::defaultFieldResolver($source, $args, $context, $info);
        });
    }
}
