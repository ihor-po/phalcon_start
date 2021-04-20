<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\DI\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View;
use Phalcon\Exception;
use Phalcon\Mvc\Model\MetaData\Apc As ApcMetaData;
use Phalcon\Session\Adapter\Files;

try {
    /** Autoloader */
    $loader = new Loader();
    $loader->registerDirs([
        __DIR__ . '/../app/controllers',
        __DIR__ . '/../app/models',
        __DIR__ . '/../app/config'
    ]);

    $loader->registerClasses([
        'Components\User' => '../app/Components/User.php',
        'Components\Helper' => '../app/Components/Helper.php'
    ]);

    $loader->register();

    /** Dependency Injection */
    $di = new FactoryDefault();

    // Return Config config
    $di->setShared('config', function () use ($config) {
        return $config;
    });

    // Return API config
    $di->setShared('api', function () use ($api) {
        return $api;
    });

    $di->set('db',  function() use($di) {
        $dbConfig = $di->get('config')->get('db')->toArray();

        return new Mysql($dbConfig);
    });

    $di->set('view', function() {
        $view = new View();
        $view->setViewsDir('../app/views');
        $view->registerEngines([
            '.volt' => Phalcon\Mvc\View\Engine\Volt::class
        ]);

        return $view;
    });

    $di->set('router', function () {
        $router = new Router();
        $router->mount(new Routes());

        return $router;
    });

    $di->setShared('session', function () {
        $session = new Files();
        $session->start();

        return $session;
    });

    $di->setShared('component', function () {
        $obj = new stdClass();
        $obj->helper = new \Components\Helper;
        $obj->user = new \Components\User;

        return $obj;
    });

    // Flash Data (Temporary Data)
    $di->set('flash', function () {
       $flash = new \Phalcon\Flash\Session([
           'error' => 'alert alert-danger',
           'success' => 'alert alert-success',
           'notice' => 'alert alert-info',
           'warning' => 'alert alert-warning'
       ]);
       return $flash;
    });

    $di['modelsMetadata'] = function () {
        $metadata = new ApcMetaData([
            'lifetime' => 86400,
            'prefix' => 'test'
        ]);

        return $metadata;
    };

    // Custom dispatcher (Overrides the default)
    $di->set('dispatcher', function() use($di) {
        $eventsManager = $di->getShared('eventsManager');

        /** Custom ACL Class */
        $permission = new Permission();

        // Listen for permission class
        $eventsManager->attach('dispatch', $permission);

        $dispatcher = new Dispatcher();
        $dispatcher->setEventsManager($eventsManager);

        return $dispatcher;
    });

    /** Deploy the App */
    $app = new Application($di);
    echo $app->handle()->getContent();

} catch(Exception $exception) {
    echo $exception->getMessage();
}
