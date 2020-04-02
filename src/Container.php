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
     * @param string $name
     * @param Closure $closure
     */
    public function addService(string $name, Closure $closure): void
    {
        $this->services[$name] = $closure;
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

    /**
     * @return array
     */
    public function getServices(): array
    {
        return [
            'services' => array_keys($this->services),
        ];
    }
}