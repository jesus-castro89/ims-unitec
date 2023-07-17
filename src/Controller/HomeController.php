<?php


namespace App\Controller;


use JetBrains\PhpStorm\Pure;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Symfony\WebpackEncoreBundle\Twig\EntryFilesTwigExtension;

class HomeController extends AbstractController
{
    #[Pure]
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }

    public function homeAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->container->get('view')->render($response, 'base.twig', [

        ]);
    }


}
