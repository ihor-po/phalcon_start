<?php


use Phalcon\Tag;

class SigninController extends BaseController
{
    public function onConstruct()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        Tag::setTitle('SignIn');
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

    public function registerAction()
    {
        Tag::setTitle('Registration');
    }

    public function registrationAction()
    {
        if ($this->security->checkToken() === false) {
            $this->flash->error('Invalid CSRF Token');
            $this->response->redirect('signin/register');
            return;
        }

        $this->view->disable();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword');

        if (empty($email) || empty($password)) {
            $this->flash->error('Your data are wrong.');
            $this->response->redirect('signin/register');
        }

        if ($password !== $confirmPassword) {
            $this->flash->error('Your password do not match.');
            $this->response->redirect('signin/register');
        }

        $user = new User();
        $user->role = 'user';
        $user->email = $email;
        $user->password = $this->security->hash($password);
        $result = $user->save();

        if (!$result) {
            $output = [];
            foreach ($user->getMessages() as $message) {
                $output[] = $message;
            }
        }

    }
}