<?php

use App\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$kernel = new Kernel();
$kernel->boot();

$conainer = $kernel->getContainer();

var_dump($conainer->getServices());