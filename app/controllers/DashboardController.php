<?php


use Phalcon\Tag;

class DashboardController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('Dashboard');
        parent::initialize();
    }
}