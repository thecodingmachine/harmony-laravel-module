<?php
namespace Harmony\Module\LaravelModule;

use Acclimate\Container\ContainerAcclimator;
use Harmony\Module\ContainerExplorerInterface;
use Harmony\Module\HarmonyModuleInterface;
use Interop\Container\ContainerInterface;
use Illuminate\Foundation\Application;

class LaravelModule implements HarmonyModuleInterface {

    private $application;
    private $acclimatedContainer;
    private $containerExplorer;

    /**
     * Creates the module from the Laravel Application.
     * If no Application instance is passed, the base application is loaded from bootstrap/app.php.
     *
     * @param Application $application
     */
    public function __construct(Application $application = null) {
        if ($application !== null) {
            $this->application = $application;
        } else {
            $this->application = require __DIR__.'/../../../../../../../bootstrap/app.php';
        }

        // Let's bootstrap the kernel. This will register most services.
        $kernel = $this->application->make('Illuminate\Contracts\Console\Kernel');
        $kernel->bootstrap();

        $acclimate = new ContainerAcclimator();
        $this->acclimatedContainer = $acclimate->acclimate($this->application);
    }

    /**
     * You can return a container if the module provides one.
     *
     * It will be chained to the application's root container.
     *
     * @param ContainerInterface $rootContainer
     * @return ContainerInterface|null
     */
    public function getContainer(ContainerInterface $rootContainer)
    {
        return $this->acclimatedContainer;
    }

    /**
     * Returns a class that can be used to explore a container
     *
     * @return ContainerExplorerInterface|null
     */
    public function getContainerExplorer()
    {
        if ($this->containerExplorer === null) {
            $this->containerExplorer = new LaravelContainerExplorer($this->application);
        }
        return $this->containerExplorer;
    }
}
