<?php


declare(strict_types=1);

use App\Format\JSON;
use App\Format\XML;
use App\Format\YAML;
use App\Service\Serializer;
use App\Controller\IndexController;
use App\Container;

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
    $container->getService('format.json');
});

$container->addService('serializer', function() use ($container) {
    return new Serializer($container->getService('format'));
});

$container->addService('controller.index', function() use ($container) {
    return new IndexController($container->getService('serializer'));
});

$controller = $container->getService('controller.index')->index();

echo '<pre>';
var_dump($container);
echo '</pre>';