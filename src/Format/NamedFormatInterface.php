<?php

declare(strict_types=1);

namespace App\Format;

/**
 * Interface NamedFormatInterface
 * @package App\Format
 */
interface NamedFormatInterface
{
    /**
     * @return mixed
     */
    public function getName();
}