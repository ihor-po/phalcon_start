<?php


use Phalcon\Mvc\Model\Behavior\SoftDelete;

class User extends BaseModel
{
    public function initialize()
    {
        $this->setSource('users');

        $this->hasMany('id', 'Project', 'user_id');

        $this->addBehavior(new SoftDelete([
            'field' => 'deleted',
            'value' => 1,
        ])
        );
    }

    public function beforeValidationOnCreate()
    {
        if ($this->email === 'test@test.com') {
            die('This email is too common!');
        }
    }
}