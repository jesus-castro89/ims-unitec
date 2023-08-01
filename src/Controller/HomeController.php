<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheCodingMachine\GraphQLite\Annotations\Query;

class HomeController extends AbstractController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function homeAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->container->get('view')->render($response, 'base.twig', [

        ]);
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $response;
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $response;
    }
}
