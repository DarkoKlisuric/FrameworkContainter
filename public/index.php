<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Container;
use App\Format\FormatInterface;

require __DIR__ . '/../vendor/autoload.php';



$data = [
    "name" => "Darko",
    "surname" => "Klisuric"
];

$json = new JSON();
$xml = new XML();
$yaml = new YAML();



$container = new Container();
$container->addService('format.json', function() use ($container) {
    return new JSON();
});

$container->addService('format.xml', function() use ($container) {
    return new XML();
});

$container->addService('format', function() use ($container) {
    return $container->getService('format.xml');
}, FormatInterface::class);


$container->loadServices('App\\Service');
$container->loadServices('App\\Controller');


echo '<pre>';
var_dump($container->getServices());
echo '</pre>';

echo '<pre>';
var_dump($container->getService('App\\Controller\\IndexController')->index());
echo '</pre>';

