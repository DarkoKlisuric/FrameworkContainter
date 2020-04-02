<?php

namespace App\Format;

/**
 * Interface FormatInterface
 * @package App\Format
 */
interface FormatInterface
{
    /**
     * @return string
     */
    public function convert(): string;

    /**
     * @param array $data
     */
    public function setData(array $data): void;
}