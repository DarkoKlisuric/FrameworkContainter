<?php

declare(strict_types=1);

namespace App\Format;

/**
 * Class JSON
 * @package App\Format
 */
class JSON extends BaseFormat implements
    FromStringInterface, NamedFormatInterface, FormatInterface
{
    /**
     * @return string
     */
   public function convert(): string
   {
       return json_encode($this->getData());
   }

    /**
     * @param $string
     * @return string
     */
    public function convertFromString($string): string
    {
        return json_decode($string, true);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'JSON';
    }
}