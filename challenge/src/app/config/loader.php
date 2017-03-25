<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerNamespaces(
    [
        'Challenge\Controller' => $config->application->controllersDir,
        'Challenge\Model' => $config->application->modelsDir,
        'Challenge\Library' => $config->application->libraryDir,
    ]
)->register();
