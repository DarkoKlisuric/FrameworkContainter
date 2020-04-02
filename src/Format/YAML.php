<?php

declare(strict_types=1);

namespace App\Format;

/**
 * Class YAML
 * @package App\Format
 */
class YAML extends BaseFormat implements
    NamedFormatInterface, FormatInterface
{
    /**
     * @return string
     */
    public function convert(): string
    {
        $result = '';

        foreach ($this->getData() as $key => $value) {
            $result .= $key . ': ' . $value . "\n";
        }

        return htmlspecialchars($result);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'YAML';
    }
}