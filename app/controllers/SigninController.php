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
        if ($this->security->checkToken() === false) {
            $this->flash->error('Invalid CSRF Token');
            $this->response->redirect('signin/index');
            return;
        }


        $this->view->disable();

        if (!$this->request->isPost()) {
            return;
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByEmail($email);

        if ($user instanceof User) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->session->set('id', $user->id);
                $this->session->set('role', $user->role);
                $this->response->redirect('dashboard/index');
                return;
            }
        }

        $this->flash->error('Incorrect Credentials');
        $this->response->redirect('signin/index');
    }
}