<?php

namespace Components;

use \Phalcon\Http\Response;

class Helper extends \Phalcon\Mvc\User\Component
{
    public function csrf(?string $redirect = null)
    {
        if ($this->security->checkToken() === false) {
            $this->flash->error('Invalid CSRF Token');

            $response = new Response();
            if ($redirect !== null) {
                $response->redirect($redirect);
            }
            return false;
        }
    }
}