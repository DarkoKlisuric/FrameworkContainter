<?php

declare(strict_types=1);

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use \App\Format\BaseFormat;

require __DIR__ . '/../vendor/autoload.php';

function convertData(\App\Format\BaseFormat $format) {
    return $format->convert();
}

function getFormatName(\App\Format\NamedFormatInterface $format) {
    return $format->getName();
}

function getFormatByName(array $formats, string $name): ?BaseFormat
{
    foreach ($formats as $format) {
        if ($format instanceof  \App\Format\NamedFormatInterface
        && $format->getName() === $name) {
            return $format;
        }
    }

    return null;
}

$data = [
    "name" => "Darko",
    "surname" => "Klisuric"
];

$json = new JSON($data);
$xml = new XML($data);
$yaml = new YAML($data);

$formats = [
    new JSON($data),
    new XML($data),
    new YAML($data)
];

var_dump(getFormatByName($formats, 'JSON'));