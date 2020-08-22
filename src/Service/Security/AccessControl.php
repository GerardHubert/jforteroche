<?php
declare(strict_types=1);

namespace App\Service\Security;

use App\View\View;
use App\Model\LogManager;

class AccessControl
{
    private $logManager;
    private $view;
    private $layout;
    private $template;

    public function __construct(LogManager $logManager, View $view)
    {
        $this->logManager = $logManager;
        $this->view = $view;
        $this->layout = '../templates/authentification/layout.html.php';
        $this->template = '../templates/authentification/';
    }

    public function logIn() : void
    {
        $data = [];
        $template = $this->template.'logInPage.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function newUser(array $formData) : void
    {
        $cryptedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
        $this->logManager->saveNewUser($formData['identifiant'], $cryptedPassword);
    }
}