<?php

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Format\FromStringInterface;
use App\Format\NamedFormatInterface;

require __DIR__ . '/../vendor/autoload.php';

$data = [
    "key" => "value",
    "key2" => "value2"
];

$json = new JSON($data);
$xml = new XML($data);
$yaml = new YAML($data);


$formats = [$json, $xml, $yaml];

foreach ($formats as $format) {
    if ($format instanceof NamedFormatInterface) {
        var_dump($format->getName());
    }

    if ($format instanceof FromStringInterface) {
        var_dump($format->convertFromString('{"name": "Darko", "surname": "Klisuric"}'));
    }
}


