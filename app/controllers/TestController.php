<?php


use Phalcon\Mvc\Controller;

class TestController extends Controller
{
    public function jumpAction(int $id = null)
    {
        echo __FUNCTION__ . $id;
    }

    public function flyAction()
    {
        echo __FUNCTION__;
        print_r($this->dispatcher->getParams());
    }
}