<?php

declare(strict_types=1);

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;

require __DIR__ . '/../vendor/autoload.php';

$data = [
    "name" => "Darko",
    "surname" => "Klisuric"
];

$formats = [
    new JSON($data),
    new XML($data),
    new YAML($data)
];
