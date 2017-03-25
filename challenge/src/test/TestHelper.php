<?php

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);

// Required for phalcon/incubator
include __DIR__ . "/../vendor/autoload.php";

// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
$loader = new Loader();

$loader->registerDirs(
    [
        ROOT_PATH
    ]
);

$loader->registerNamespaces(
    [
        'Challenge\Controller' => __DIR__ . "/../app/controllers",
        'Challenge\Model' => __DIR__ . "/../app/models",
        'Challenge\Library' => __DIR__ . "/../app/library",
    ]
)->register();

$di = new FactoryDefault();

Di::reset();

// Add any needed services to the DI here

Di::setDefault($di);