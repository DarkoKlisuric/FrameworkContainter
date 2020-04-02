<?php

declare(strict_types=1);

namespace App\Format;

class JSON extends BaseFormat implements
    FromStringInterface, NamedFormatInterface, FormatInterface
{
   public function convert(): string
   {
       return json_encode($this->getData());
   }

    public function convertFromString($string): string
    {
        return json_decode($string, true);
    }

    public function getName(): string
    {
        return 'JSON';
    }
}