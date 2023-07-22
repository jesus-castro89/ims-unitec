<?php

use Lcharette\WebpackEncoreTwig\EntrypointsTwigExtension;
use Lcharette\WebpackEncoreTwig\TagRenderer;
use Odan\Twig\TwigAssetsExtension;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Http\Environment;
use Slim\Http\Uri;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Slim\Views\TwigRuntimeLoader;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\NativeSessionTokenStorage;
use Symfony\Component\Translation\Translator;
use Symfony\WebpackEncoreBundle\Asset\EntrypointLookup;
use Twig\Loader\FilesystemLoader;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
    //APP
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
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
