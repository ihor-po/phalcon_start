<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/../config.php';

use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\DI\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\View;
use Phalcon\Exception;
use Phalcon\Mvc\Model\MetaData\Apc As ApcMetaData;

try {
    /** Autoloader */
    $loader = new Loader();
    $loader->registerDirs([
        __DIR__ . '/../app/controllers',
        __DIR__ . '/../app/models'
    ]);

    $loader->register();

    /** Dependency Injection */
    $di = new FactoryDefault();

    $di->set('db',  function() {
        return new Mysql([
            'host' => DB_HOST,
            'username' => DB_USER,
            'password' => DB_PASSWORD,
            'dbname' => DB_NAME,
            'port' => DB_PORT,
        ]);
    });

    $di->set('view', function() {
        $view = new View();
        $view->setViewsDir('../app/views');

        return $view;
    });

    $di->setShared('session', function () {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();

        return $session;
    });

    $di['modelsMetadata'] = function () {
        $metadata = new ApcMetaData([
            'lifetime' => 86400,
            'prefix' => 'test'
        ]);

        return $metadata;
    };

    /** Deploy the App */
    $app = new Application($di);
    echo $app->handle()->getContent();

} catch(Exception $exception) {
    echo $exception->getMessage();
}
