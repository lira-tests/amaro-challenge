<?php

use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;

error_reporting(E_ALL);

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers
     * the services that provide a full stack framework.
     */
    $di = new FactoryDefault();

    /**
     * Handle routes
     */
    include APP_PATH . '/config/router.php';

    /**
     * Read services
     */
    include APP_PATH . '/config/services.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * Handle the request
     */
    $application = new Micro($di);

    $application->get(
        "/",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->get(
        "/products",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->post(
        "/products",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->put(
        "/products/{id_product}",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->get(
        "/products/{id_product}",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->get(
        "/orders",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->get(
        "/orders/{id_order}",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->post(
        "/orders",
        [
            new \Challenge\Controller\IndexController(),
            'indexAction'
        ]
    );

    $application->after(
        function () use ($application) {
            // This is executed after the route is executed
            echo json_encode($application->getReturnedValue());
        }
    );

    echo $application->handle();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
