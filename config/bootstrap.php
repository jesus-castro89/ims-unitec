<?php
use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config.php';

$containerBuilder = new ContainerBuilder();

// Add DI container definitions
$containerBuilder->addDefinitions(__DIR__ . '/container.php');

// Create DI container instance
try {
    $container = $containerBuilder->build();
} catch (Exception $e) {
}

// Create Slim App instance
try {
    $app = $container->get(App::class);
} catch (\DI\DependencyException $e) {
} catch (\DI\NotFoundException $e) {
}

// Register routes
(require __DIR__ . '/routes.php')($app);

// Register middleware
(require __DIR__ . '/middleware.php')($app);

return $app;