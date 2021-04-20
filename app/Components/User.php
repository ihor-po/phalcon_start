<?php

namespace Components;

use User as UserModel;

class User extends \Phalcon\Mvc\User\Component
{
    public function createSession(UserModel $user)
    {
        $this->session->set('id', $user->id);
        $this->session->set('role', $user->role);
    }
}
