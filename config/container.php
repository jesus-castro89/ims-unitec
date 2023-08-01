<?php

use App\Controller\HomeController;
use GraphQL\Executor\Promise\PromiseAdapter;
use GraphQL\Type\Schema;
use Lcharette\WebpackEncoreTwig\EntrypointsTwigExtension;
use Lcharette\WebpackEncoreTwig\TagRenderer;
use Phoole\Cache\Cache;
use Psr\Container\ContainerInterface;
use Psr\SimpleCache\CacheInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Psr7\Factory\StreamFactory;
use Slim\Views\Twig;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Translation\Translator;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use TheCodingMachine\GraphQLite\Http\Psr15GraphQLMiddlewareBuilder;
use TheCodingMachine\GraphQLite\Http\WebonyxGraphqlMiddleware;
use TheCodingMachine\GraphQLite\SchemaFactory;
use Twig\RuntimeLoader\FactoryRuntimeLoader;
use function DI\autowire;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
    //APP
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },
    // The WebonyxGraphqlMiddleware is a PSR-15 compatible
    // middleware that exposes Webonyx schemas.
    WebonyxGraphqlMiddleware::class => function (ContainerInterface $container) {
        $builder = new Psr15GraphQLMiddlewareBuilder($container->get(Schema::class));
        $builder->setResponseFactory($container->get(ResponseFactory::class));
        $builder->setStreamFactory($container->get(StreamFactory::class));
        return $builder->createMiddleware();
    },
    CacheInterface::class => function () {
        return new Cache();
    },
    Schema::class => function (ContainerInterface $container) {
        // The magic happens here. We create a schema using GraphQLite SchemaFactory.
        $factory = new SchemaFactory($container->get(CacheInterface::class), $container);
        $factory->addControllerNamespace('App\\Controller\\');
        $factory->addTypeNamespace('App\\');
        return $factory->createSchema();
    },
    HomeController::class => function (ContainerInterface $container) {
        return new HomeController($container);
    },
    //Twig
    'view' => function (ContainerInterface $container) {
        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new NativeSessionTokenStorage();
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);
        $defaultFormTheme = 'bootstrap_5_layout.html.twig';
        $appVariableReflection = new \ReflectionClass('\Symfony\Bridge\Twig\AppVariable');
        $vendorTwigBridgeDir = dirname($appVariableReflection->getFileName());
        $twig = Twig::create(
            [
                __DIR__ . '/../templates',
                $vendorTwigBridgeDir . '/Resources/views/Form'
            ],
            ['cache' => false]);
        $formEngine = new TwigRendererEngine(array(
            $defaultFormTheme,
        ), $twig->getEnvironment());
        $twig->addRuntimeLoader(new FactoryRuntimeLoader([
            FormRenderer::class => function () use ($formEngine, $csrfManager) {
                return new FormRenderer($formEngine, $csrfManager);
            }
        ]));
        $entryPoints = new EntrypointLookup(__DIR__ . '/../public/build/entrypoints.json');
        $tagRenderer = new TagRenderer($entryPoints);
        $extension = new EntrypointsTwigExtension($entryPoints, $tagRenderer);
        $twig->addExtension($extension);
        $twig->addExtension(new FormExtension());
        $twig->addExtension(new TranslationExtension(new Translator('en')));
        return $twig;
    },
];
