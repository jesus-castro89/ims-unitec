<?php


namespace App\Controller;


use App\Category;
use App\Model\CategoryModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheCodingMachine\GraphQLite\Annotations\Query;

class CategoryController extends AbstractController
{

    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->model = new CategoryModel();
    }

    public function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->loadDashboard("category.twig", $request, $response);
    }

    public function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        return $this->model->filterByPrimaryKey("Id", $request, $response, $args);
    }
}
