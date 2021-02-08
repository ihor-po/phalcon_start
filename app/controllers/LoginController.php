<?php


class LoginController extends \Phalcon\Mvc\Controller
{
    public function onConstruct()
    {
        echo "****** CONSTRUCT *****<br/>";
    }

    public function initialize()
    {
        echo "****** INIT *****<br/>";
    }

    public function indexAction()
    {
        echo "Login";
    }

    public function processAction($userName = false, $age = 12)
    {
        echo "Processing<be/>";

        $this->view->setVar('userName', $userName);
        $this->view->setVar('age', $age);

        $this->view->disableLevel(\Phalcon\Mvc\View::LEVEL_AFTER_TEMPLATE);
    }

    public function testAction()
    {
        echo "<br/>------- TEST ACTION --------";
    }
}