<?php

namespace App\Service;

use App\Format\FormatInterface;

/**
 * Class Serializer
 * @package App\Service
 */
class Serializer
{
    /**
     * @var FormatInterface
     */
    private FormatInterface $format;

    public function __construct(FormatInterface $format)
    {
        $this->format = $format;
    }

    /**
     * @param $data
     * @return string
     */
    public function serialize($data): string
    {
        $this->format->setData($data);

        return $this->format->convert();
    }
}