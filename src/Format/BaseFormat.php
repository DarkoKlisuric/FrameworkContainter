<?php

namespace App\Format;

/**
 * Class BaseFormat
 * @package App\Format
 */
abstract class BaseFormat
{
    private $data;

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public abstract function convert();

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->convert();
    }
}