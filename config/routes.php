<?php

use App\Controller\ClienteController;
use App\Controller\HomeController;
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
};
