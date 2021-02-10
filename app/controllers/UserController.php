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
        $user->email = 'test@test.com';
        $user->password = 'test';
        $user->created_at = date('Y-m-d H:i:s');
        $result = $user->save();

        if (!$result) {
            return print_r($user->getMessages());
        }
    }

    public function updateAction()
    {
        $user = User::findFirstById(1);

        if (!$user) {
            echo 'User does not exist';
            die;
        }

        $user->email = 'new-email@test.com';
        $user->updated_at = date('Y-m-d H:i:s');
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