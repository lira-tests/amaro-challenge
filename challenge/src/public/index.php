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

    /**
     * Set to use query strings
     */
    $application->getRouter()->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);


    $application->get(
        "/",
        [
            new \Challenge\Controller\IndexController(),
            'index'
        ]
    );

    $application->get(
        "/products",
        [
            new \Challenge\Controller\IndexController(),
            'products'
        ]
    );

    $application->post(
        "/products",
        [
            new \Challenge\Controller\IndexController(),
            'createProduct'
        ]
    );

    $application->put(
        "/products/{id_product}",
        [
            new \Challenge\Controller\IndexController(),
            'updateProduct'
        ]
    );

    $application->get(
        "/products/{id_product}",
        [
            new \Challenge\Controller\IndexController(),
            'getProduct'
        ]
    );

    $application->get(
        "/orders",
        [
            new \Challenge\Controller\IndexController(),
            'orders'
        ]
    );

    $application->get(
        "/orders/{id_order}",
        [
            new \Challenge\Controller\IndexController(),
            'orders'
        ]
    );

    $application->get(
        "/orders/{id_order}/products",
        [
            new \Challenge\Controller\IndexController(),
            'orderItems'
        ]
    );

    $application->post(
        "/orders",
        [
            new \Challenge\Controller\IndexController(),
            'createOrder'
        ]
    );

    $application->notFound(function () use ($application) {
        $application->response->setStatusCode(404);

        echo  json_encode([
            'Não encontrado'
        ]);
    });

    $application->after(
        function () use ($application) {
            $application->response->setContentType('application/json', 'UTF-8');
            $application->response->setJsonContent($application->getReturnedValue());
            $application->response->send();
        }
    );

    $application->handle();

} catch (\Exception $e) {
    echo $e->getMessage() . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
