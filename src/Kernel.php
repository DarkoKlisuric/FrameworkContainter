<?php

namespace App;

use App\Format\FormatInterface;
use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;

class Kernel
{
    /**
     * @var Container
     */
    private Container $container;

    /**
     * Kernel constructor.
     */
    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    public function boot()
    {
        $this->bootContainer($this->container);
    }

    /**
     * @param Container $container
     */
    private function bootContainer(Container $container)
    {
        $container->addService('format.json', function() use ($container) {
            return new JSON();
        });

        $container->addService('format.xml', function() use ($container) {
            return new XML();
        });

        $container->addService('format.yaml', function() use ($container) {
            return new YAML();
        });

        $container->addService('format', function() use ($container) {
            return $container->getService('format.xml');
        }, FormatInterface::class);
    }
}