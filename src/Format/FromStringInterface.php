<?php

declare(strict_types=1);

namespace App\Format;

/**
 * Interface FromStringInterface
 * @package App\Format
 */
interface FromStringInterface
{
    /**
     * @param $string
     * @return string
     */
    public function convertFromString($string): string;
}