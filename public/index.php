<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

use Phalcon\DI\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;

try {
    /** Autoloader */
    $loader = new Loader();
    $loader->registerDirs([
            '../app/controllers',
            '../app/models'
    ]);

    $loader->register();

    /** Dependency Injection */
    $di = new FactoryDefault();
    $di->set('view', function() {
        $view = new View();
        $view->setViewsDir('../app/views');

        return $view;
    });

    /** Deploy the App */
    $app = new Application($di);
    echo $app->handle()->getContent();

} catch(\Phalcon\Exception $exception) {
    echo $exception->getMessage();
}
