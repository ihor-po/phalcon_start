<?php


use Phalcon\Tag;

class SigninController extends BaseController
{
    public function indexAction()
    {
        Tag::setTitle('SignIn');
        parent::initialize();
    }

    public function signinAction()
    {
        $this->view->disable();

        if (!$this->request->isPost()) {
            return;
        }

        $user = User::findFirst([
            'email = :email:
            AND
            password = :password:',
            "bind" => [
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password')
            ]
        ]);

        if ($user) {

            $this->session->set('id', $user->id);
            $this->session->set('role', $user->role);
            $this->response->redirect('dashboard/index');
            return;
        }

        $this->flash->error('Incorrect Credentials');
        $this->response->redirect('signin/index');
    }
}