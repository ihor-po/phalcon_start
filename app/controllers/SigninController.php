<?php


use Phalcon\Tag;

class SigninController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('SignIn');
        parent::initialize();
    }
}