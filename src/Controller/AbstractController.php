<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    protected ContainerInterface $container;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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
}
