<?php

use Phalcon\Acl\Adapter\Memory;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use \Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Event;
use \Phalcon\Acl;
use Phalcon\Mvc\User\Plugin;

class Permission extends Plugin
{
    public const GUEST = 'guest';
    public const USER = 'user';
    public const ADMIN = 'admin';

    protected $_publicResources = [
        'index' => ['*'],
        'signin' => ['*']
    ];

    protected $_userResources = [
        'dashboard' => ['*']
    ];

    protected $_adminResources = [
        'admin' => ['*']
    ];

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
//        $this->session->destroy();

        $role = $this->session->get('role');

        if (!$role) {
            $role = self::GUEST;
        }

        // Get current controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Get the ACL Rule List
        $acl = $this->_getAcl();

        // See if they have permission
        $allowed = $acl->isAllowed($role, $controller, $action);

        if($allowed !== (bool)Acl::ALLOW) {

            $this->flash->error('You do not have permission to access this area.');
            $this->response->redirect('index');

            // Stops the dispatcher
            return false;
        }
    }

    protected function _getAcl()
    {
        if (!isset($this->persistent->acl)) {
            $acl = new Memory();
            $acl->setDefaultAction(Acl::DENY);

            $roles = [
                self::GUEST => new Role(self::GUEST),
                self::USER => new Role(self::USER),
                self::ADMIN => new Role(self::ADMIN)
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Public resources
            foreach ($this->_publicResources as $resource => $action) {
                $acl->addResource(new Resource($resource), $action);
            }

            // User resources
            foreach ($this->_userResources as $resource => $action) {
                $acl->addResource(new Resource($resource), $action);
            }

            // Admin resources
            foreach ($this->_adminResources as $resource => $action) {
                $acl->addResource(new Resource($resource), $action);
            }

            // Allow All Roles to access the public resources
            foreach ($roles as $role) {
                foreach ($this->_publicResources as $resource => $actions) {
                    echo $resource;
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            foreach ($this->_userResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::USER, $resource, $action);
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            foreach ($this->_adminResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow(self::ADMIN, $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }
}