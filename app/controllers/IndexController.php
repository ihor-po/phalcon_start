<?php


use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
    public function indexAction()
    {
        echo "Hallo World";
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

    public function destroySessionAction()
    {
        $this->session->destroy('name');
    }
}