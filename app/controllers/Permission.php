<?php

use \Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;

class Permission extends \Phalcon\Mvc\User\Plugin
{
    protected $_publicResources = [
        'index' => ['*'],
        'signin' => ['*']
    ];

    protected $_privateResources = [
        'dashboard' => ['*']
    ];

    protected $_adminResources = [
        'admin' => ['*']
    ];

    protected function _getAcl()
    {
        if (!isset($this->persistent->acl)) {

        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
    }
}