<?php

use \Phalcon\Tag;

class IndexController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Home');
        parent::initialize();
    }

    public function startSessionAction()
    {
        $this->session->set('name', 'Jhon Dou');
    }

    public function getSessionAction()
    {
        echo $this->session->get('name');
    }

    public function removeSessionAction()
    {
        $this->session->remove('name');
    }

    public function signoutAction()
    {
        $this->session->destroy();
        $this->response->redirect('index/');
    }
}