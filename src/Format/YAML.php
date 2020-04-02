<?php

declare(strict_types=1);

namespace App\Format;

class YAML extends BaseFormat implements
    NamedFormatInterface, FormatInterface
{
    public function convert()
    {
        $result = '';

        foreach ($this->getData() as $key => $value) {
            $result .= $key . ': ' . $value . "\n";
        }

        return htmlspecialchars($result);
    }

    public function getName(): string
    {
        return 'YAML';
    }
}