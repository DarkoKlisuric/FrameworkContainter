<?php

namespace App;

use Closure;

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
}