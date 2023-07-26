<?php

use App\Controller\ClienteController;
use App\Controller\HomeController;
use App\Controller\ProductoController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    //$app->VERBO('/RUTA', XController::class . ':functionAction');
    $app->get('/[index[/{prueba}]]', HomeController::class . ':homeAction')
        ->setName("dashboardIndex");
    $app->group("/api", function (RouteCollectorProxy $group) {
        $group->group("/cliente", function (RouteCollectorProxy $group) {
            $group->get("/all", ClienteController::class . ":getAllAction");
            $group->get("/{id}", ClienteController::class . ":filterByCodigoClienteAction");
        });
    });
    $app->group("/cliente", function (RouteCollectorProxy $group) {

        $group->get("[/]", ClienteController::class . ":dashboardAction")
            ->setName("clienteDashboard");
        $group->get("/add", ClienteController::class . ":formAction")
            ->setName("clienteAdd");
        $group->map(['POST', 'GET'], "/edit", ClienteController::class . ":formAction")
            ->setName("clienteEdit");
        $group->get("/tableData[/{limit}/{offset}]", ClienteController::class . ":tableAction")
            ->setName("clienteTable");
        $group->get("/tableData/{search}/{limit}/{offset}", ClienteController::class . ":tableAction")
            ->setName("clienteSearch");
    });
    $app->group("/producto", function (RouteCollectorProxy $group) {

        $group->get("[/]", ProductoController::class . ":dashboardAction")
            ->setName("productoDashboard");
        $group->get("/add", ProductoController::class . ":formAction")
            ->setName("productoAdd");
        $group->map(['POST', 'GET'], "/edit", ProductoController::class . ":formAction")
            ->setName("productoEdit");
        $group->get("/tableData[/{limit}/{offset}]", ProductoController::class . ":tableAction")
            ->setName("productoTable");
        $group->get("/tableData/{search}/{limit}/{offset}", ProductoControllerController::class . ":tableAction")
            ->setName("productoSearch");
    });
};
