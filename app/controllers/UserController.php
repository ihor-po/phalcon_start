<?php


use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->view->setVars([
           'single' => User::findFirstById(1),
           'all' => User::find([
               'deleted is NULL'
           ])
        ]);
    }

    public function createAction()
    {
        $user = new User();
        $user->email = 'test+1@test.com';
        $user->password = 'test';
        $result = $user->save();

        if (!$result) {
            return print_r($user->getMessages());
        }
    }

    public function createAssocAction()
    {
        $user = User::findFirstById(2);

        if (!$user) {
            echo 'User does not exist';
            die;
        }

        $project = new Project();
        $project->user = $user;
        $project->title = "MoonWalker";

        $result = $project->save();
    }

    public function updateAction()
    {
        $user = User::findFirstById(4);

        if (!$user) {
            echo 'User does not exist';
            die;
        }

        $user->email = 'new-email@test.com';
        $result = $user->update();

        if (!$result) {
            return print_r($user->getMessages());
        }
    }

    public function deleteAction()
    {
        $user = User::findFirstById(3);

        if (!$user) {
            echo 'User does not exist';
            die;
        }
        $result = $user->delete();

        if (!$result) {
            return print_r($user->getMessages());
        }
    }
}