<?php

use App\Controller\ClientController;
use App\Controller\GraphQLController;
use App\Controller\HomeController;
use App\Controller\CategoryController;
use App\Controller\ProductController;
use GraphQL\GraphQL;
use GraphQL\Server\RequestError;
use GraphQL\Server\ServerConfig;
use GraphQL\Server\StandardServer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use TheCodingMachine\GraphQLite\SchemaFactory;
use GraphQL\Type\Schema;

return function (App $app) {
    //$app->VERBO('/RUTA', XController::class . ':functionAction');
    $app->get('/[index[/{prueba}]]', HomeController::class . ':homeAction')
        ->setName("dashboardIndex");
    $app->group("/api", function (RouteCollectorProxy $group) {
        $group->group("/category", function (RouteCollectorProxy $group) {
            $group->get("/all", CategoryController::class . ":getAllAction");
            $group->get("/{id}", CategoryController::class . ":filterByPrimaryKeyAction");
        });
    });
    //
    $app->any('/graphql', GraphQLController::class . ":indexAction");
    //Productos
    $app->group("/product", function (RouteCollectorProxy $group) {

        $group->get("[/]", ProductController::class . ":dashboardAction")
            ->setName("productDashboard");
        $group->get("/add", ProductController::class . ":formAction")
            ->setName("productAdd");
        $group->map(['POST', 'GET'], "/edit", ProductController::class . ":formAction")
            ->setName("productEdit");
        $group->get("/tableData[/{limit}/{offset}]", ProductController::class . ":tableAction")
            ->setName("productTable");
        $group->get("/tableData/{search}/{limit}/{offset}", ProductController::class . ":tableAction")
            ->setName("productSearch");
    });
    //Categorías de Productos
    $app->group("/category", function (RouteCollectorProxy $group) {

        $group->get("[/]", CategoryController::class . ":dashboardAction")
            ->setName("categoryDashboard");
        $group->get("/add", CategoryController::class . ":formAction")
            ->setName("categoryAdd");
        $group->map(['POST', 'GET'], "/edit", CategoryController::class . ":formAction")
            ->setName("categoryEdit");
        $group->get("/tableData[/{limit}/{offset}]", CategoryController::class . ":tableAction")
            ->setName("categoryTable");
        $group->get("/tableData/{search}/{limit}/{offset}", CategoryController::class . ":tableAction")
            ->setName("categorySearch");
    });
    //Clientes de la tienda
    $app->group("/client", function (RouteCollectorProxy $group) {

        $group->get("[/]", ClientController::class . ":dashboardAction")
            ->setName("clientDashboard");
        $group->get("/add", ClientController::class . ":formAction")
            ->setName("clientAdd");
        $group->map(['POST', 'GET'], "/edit", ClientController::class . ":formAction")
            ->setName("clientEdit");
        $group->get("/tableData[/{limit}/{offset}]", ClientController::class . ":tableAction")
            ->setName("clientTable");
        $group->get("/tableData/{search}/{limit}/{offset}", ClientController::class . ":tableAction")
            ->setName("clientSearch");
    });
};
