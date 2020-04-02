<?php

declare(strict_types=1);

namespace App\Format;

/**
 * Class XML
 * @package App\Format
 */
class XML extends BaseFormat implements
    NamedFormatInterface, FormatInterface
{
    /**
     * @return string
     */
    public function convert():string
    {
        $result = '';

        foreach ($this->getData() as $key => $value) {
            $result .= '<'. $key . '>' . $value . '</' . $key .'>';
        }

        return htmlspecialchars($result);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'XML';
    }
}