<?php

namespace App;

use App\Annotations\Route;
use App\Format\FormatInterface;
use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

class Kernel
{
    /**
     * @var Container
     */
    private Container $container;

    /**
     * @var array
     */
    private array $routes = [];

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
        try {
            $this->bootContainer($this->container);
        } catch (AnnotationException $e) {
            $e->getMessage();
        }

        return $this;
    }

    /**
     * @param Container $container
     * @throws AnnotationException
     */
    private function bootContainer(Container $container)
    {
        $container->addService('format.json', function () use ($container) {
            return new JSON();
        });

        $container->addService('format.xml', function () use ($container) {
            return new XML();
        });

        $container->addService('format.yaml', function () use ($container) {
            return new YAML();
        });

        $container->addService('format', function () use ($container) {
            return $container->getService('format.json');
        }, FormatInterface::class);

        AnnotationRegistry::registerLoader('class_exists');

        $reader = new AnnotationReader();

        $routes = [];

        $container->loadServices(
            'App\\Controller',
            function (string $serviceName, \ReflectionClass $class) use ($reader, &$routes) {
                $route = $reader->getClassAnnotation($class, Route::class);

                if (!$route) {
                    return;
                }

                $baseRoute = $route->route;

                foreach ($class->getMethods() as $method) {
                    $route = $reader->getMethodAnnotation($method, Route::class);

                    if (!$route) {
                        continue;
                    }

                    $routes[str_replace('//', '/', $baseRoute . $route->route)] = [
                        'service' => $serviceName,
                        'method' => $method->getName()
                    ];
                }
            });
        $this->routes = $routes;
    }

    public function handleRequest()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];

            $response = $this->getContainer()->getService($route['service'])
                ->{$route['method']}();

            echo $response;

            die;
        }
    }
}