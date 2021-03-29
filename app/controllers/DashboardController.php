<?php


use Phalcon\Tag;

class DashboardController extends BaseController
{
    public function indexAction()
    {
        echo 'Dashboard';
//        Tag::setTitle('Dashboard');
//        parent::initialize();
    }
}