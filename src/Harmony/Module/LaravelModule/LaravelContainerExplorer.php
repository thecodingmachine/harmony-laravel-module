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
        // Let's find if a service is tied to this class/interface
        if ($this->container->bound($type)) {
            return [ $type ];
        } else {
            return [];
        }
    }

    /**
     * Returns the name of the instances whose tag is `$tag`
     *
     * @param string $tag The tag to retrieve
     * @return string[]
     */
    public function getInstancesByTag($tag)
    {
        $instances = $this->container->tagged($tag);
        if (!empty($instances)) {
            return array_map(function($instance) { return get_class($instance); }, $instances);
        } else {
            return [];
        }
    }
}
