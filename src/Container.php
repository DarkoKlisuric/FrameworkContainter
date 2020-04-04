<?php

namespace App;

use Closure;
use ReflectionClass;

/**
 * Class Container
 * @package App
 */
class Container
{
    /**
     * @var array
     */
    private array $services = [];

    /**
     * @var array
     */
    private array $aliases = [];

    /**
     * @param string $name
     * @param Closure $closure
     * @param string $alias
     */
    public function addService(string $name, Closure $closure, ?string  $alias = null): void
    {
        $this->services[$name] = $closure;

        if ($alias) {
            $this->addAlias($alias, $name);
        }
    }

    public function addAlias(string $alias, string $service): void
    {
        $this->aliases[$alias] = $service;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasService(string $name): bool
    {
        return isset($this->services[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAlias(string $name): bool
    {
        return isset($this->aliases[$name]);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getService(string $name)
    {
        if (!$this->hasService($name)) {

            return null;
        }
        if ($this->services[$name] instanceof Closure) {
            $this->services[$name] = $this->services[$name]();
        }

        return $this->services[$name];
    }

    public function getAlias(string $name)
    {
        return $this->getService($this->aliases[$name]);
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return [
            'services' => array_keys($this->services),
            'aliases' => $this->aliases
        ];
    }

    public function loadServices(string $namespace, \Closure $closure = null): void
    {
        $baseDir = __DIR__ . '/';

        $actualDirectory = str_replace('\\', '/', $namespace);

        $actualDirectory = $baseDir . substr(
            $actualDirectory,
                strpos($actualDirectory, '/') +1
            );

        $files = array_filter(scandir($actualDirectory), function ($file) {
            return $file !== '.' && $file !== '..';
        });

        foreach ($files as $file) {

            try {
                $class = new ReflectionClass(
                    $namespace . '\\' . basename($file, '.php')
                );
                $serviceName = $class->getName();

                $constructor = $class->getConstructor();

                $arguments = $constructor->getParameters();

                foreach ($arguments as $argument) {

                    $type = $argument->getClass()->getName();

                    $serviceParamters = [];

                    if ($this->hasService($type) || $this->hasAlias($type)) {
                        $serviceParamters[] = $this->getService($type)
                            ?? $this->getAlias($type);
                    } else {
                        $serviceParamters[] = function () use ($type) {
                            return $this->getService($type)
                                ?? $this->getAlias($type);
                        };
                    }
                }

                $this->addService($serviceName, function () use ($serviceName, $serviceParamters) {
                    foreach ($serviceParamters as &$serviceParamter) {
                        if ($serviceParamter instanceof \Closure) {
                            $serviceParamter = $serviceParamter();
                        }
                    }

                    return new $serviceName(...$serviceParamters);
                });

                if ($closure) {
                    $closure($serviceName, $class);
                }
            } catch (\ReflectionException $e) {
                $e->getMessage();
            }
        }
    }
}