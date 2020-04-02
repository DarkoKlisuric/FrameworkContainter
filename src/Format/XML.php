<?php

declare(strict_types=1);

namespace App\Format;

class XML extends BaseFormat implements NamedFormatInterface
{
    public function convert()
    {
        $result = '';

        foreach ($this->getData() as $key => $value) {
            $result .= '<'. $key . '>' . $value . '</' . $key .'>';
        }

        return htmlspecialchars($result);
    }

    public function getName(): string
    {
        return 'XML';
    }
}