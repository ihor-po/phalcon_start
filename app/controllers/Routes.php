<?php

use Phalcon\Mvc\Router\Group;

class Routes extends Group
{
    public function initialize()
    {
        $this->add('/superhero/jump', [
            'controller' => 'test',
            'action' => 'jump',
            'id' => 1
        ]);
        $this->add('/superhero/jump/:int', [
            'controller' => 'test',
            'action' => 'jump',
            'id' => 1
        ]);
        $this->add('/superhero/fly/:params', [
            'controller' => 'test',
            'action' => 'fly',
            'params' => 1
        ]);
    }
}