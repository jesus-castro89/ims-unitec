<?php

namespace App\Controller;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    protected ContainerInterface $container;

    protected $model;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public abstract function dashboardAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;

    public abstract function filterByPrimaryKeyAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface;

    protected function loadDashboard($view, ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        try {
            return $this->container->get('view')->render($response, $view, [

            ]);
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            return $response;
        }
    }

    public function formAction(ServerRequestInterface $request, ResponseInterface $response, array $args)
    {

        return $this->model->getForm($this->container, $request, $response, $args);
    }

    public function getAllAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->getAll($request, $response, $args);
    }

    public function tableAction(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        return $this->model->tableLoader($request, $response, $args);
    }

    /**
     * Get the value of container
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * Set the value of container
     *
     * @param $container
     * @return  self
     */
    public function setContainer($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }
}
