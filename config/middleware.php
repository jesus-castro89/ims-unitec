<?php

use App\Application\Middleware\JsonBodyParserMiddleware;
use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();
    // Add the Slim built-in routing middleware
    $app->addRoutingMiddleware();
    //Whops!
    $app->add(new Zeuxisoo\Whoops\Slim\WhoopsMiddleware([
        'enable' => true,
        'editor' => 'sublime',
        'title' => 'Parece que hay un error',
    ]));
    //Twig
    // Add Twig-View Middleware
    $app->add(TwigMiddleware::createFromContainer($app));
    //Add Base Path
    $app->setBasePath('/ims');
};
