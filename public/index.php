<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Kernel;

require __DIR__ . '/../vendor/autoload.php';

$kernel = (new Kernel())->boot();
$kernel->handleRequest();

