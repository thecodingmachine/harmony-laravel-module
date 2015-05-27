<?php
namespace Harmony\Module\LaravelModule;


use Harmony\Module\ContainerExplorerInterface;
use Illuminate\Container\Container;

class LaravelContainerExplorer implements ContainerExplorerInterface {
    private $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container) {
        $this->container = $container;
    }

    /**
     * Returns the name of the instances implementing `$type`.
     * Since in Laravel, there is at most one service per type, this will return one instance max.
     *
     * @param string $type
     * @return string[]
     */
    public function getInstancesByType($type)
    {
        if ($this->container->bound($type)) {
            return [$type];
        } else {
            return [];
        }
    }
}
