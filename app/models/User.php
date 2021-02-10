<?php


use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class User extends Model
{
    public function initialize()
    {
        $this->setSource('users');

        $this->addBehavior(new SoftDelete([
            'field' => 'deleted',
            'value' => 1,
        ])
        );
    }
}