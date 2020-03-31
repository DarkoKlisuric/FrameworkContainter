<?php

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;

require __DIR__ . '/../vendor/autoload.php';

$data = [
    "key" => "value",
    "key2" => "value2"
];

$json = new JSON($data);
$xml = new XML($data);
$yaml = new YAML($data);

var_dump($json->convert());
var_dump($xml->convert());
var_dump($yaml->convert());


