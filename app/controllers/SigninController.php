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
        $this->view->disable();
        $this->component->helper->csrf('signin/index');

        if (!$this->request->isPost()) {
            return;
        }

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = User::findFirstByEmail($email);

        if ($user instanceof User) {
            if ($this->security->checkHash($password, $user->password)) {
                $this->component->user->createSession($user);
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
        $this->view->disable();
        $this->component->helper->csrf('signin/register');

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirmPassword');

        if ($password !== $confirmPassword) {
            $this->flash->error('Your password do not match.');
            $this->response->redirect('signin/register');
        }

        $user = new User();
        $user->role = 'user';
        $user->email = $email;
        $user->password = $password;

        $result = $user->validation();
        if (!$result) {
            $output = [];
            foreach ($user->getMessages() as $message) {
                $output[] = $message;
            }
            $this->showValidationError($output, 'signin/register');
            return;
        }

        $result = $user->save();

        if (!$result) {
            $output = [];
            foreach ($user->getMessages() as $message) {
                $output[] = $message;
            }
            $this->showValidationError($output, 'signin/register');
            return;
        }

        $this->component->user->createSession($user);
        $this->response->redirect('dashboard/index');
    }

    private function showValidationError(array $errors, string $url): void
    {
        $errors = implode(PHP_EOL, $errors);
        $this->flash->error($errors);
        $this->response->redirect($url);
    }
}