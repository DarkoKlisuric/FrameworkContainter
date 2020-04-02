<?php

declare(strict_types=1);

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Serializer;

require __DIR__ . '/../vendor/autoload.php';

$data = [
    "name" => "Darko",
    "surname" => "Klisuric"
];

$serializer = new Serializer(new JSON());
var_dump($serializer->serialize($data));
