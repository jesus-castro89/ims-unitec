<?php

use App\Application\Middleware\JsonBodyParserMiddleware;
use GraphQL\Type\Schema;
use Slim\App;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Views\TwigMiddleware;
use Phoole\Cache\Cache;
use TheCodingMachine\GraphQLite\Http\HttpCodeDecider;
use TheCodingMachine\GraphQLite\Http\Psr15GraphQLMiddlewareBuilder;
use TheCodingMachine\GraphQLite\Http\WebonyxGraphqlMiddleware;
use TheCodingMachine\GraphQLite\SchemaFactory;

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
    //Config GraphQL
    $app->add($app->getContainer()->get(WebonyxGraphqlMiddleware::class));
    //Add Base Path
    $app->setBasePath('/ims');
};
