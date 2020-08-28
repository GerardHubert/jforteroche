<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\Model\UserManager;
use App\View\View;
use App\Service\Http\Session;

class UserController
{
    private $userManager;
    private $view;
    private $layout;
    private $template;
    private $session;

    public function __construct(UserManager $userManager, View $view, Session $session)
    {
        $this->userManager = $userManager;
        $this->session = $session;
        $this->view = $view;
        $this->layout = '../templates/authentification/layout.html.php';
        $this->template = '../templates/authentification/';
    }

    public function authentification() : void
    {
        $data = [];
        $template = $this->template.'logInPage.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function logIn(array $formData) : void
    {
        //récupération id et mot de passe saisis
        $user = $formData['identifiant'];
        $pass = $formData['password'];
        $users = $this->userManager->getUsers();

        if ($user === $users[0]['username']) {
        
            switch (password_verify($pass, $users[0]['pass'])) {
                case true:
                    //on transmet à la classe session les variables à enregistrer
                    //puis on redirige vers le backoffice
                    $this->session->setSessionVar($user);
                    header('Location: index.php?action=episodes_list');
                    //exit;
                break;

                case false:
                    echo 'le mot de passe est incorrect <br/>';
                break;
            }
        }
        elseif ($user !== $users[0]['username']) {
            echo 'utilisateur non trouvé <br/>';
        }
    }

    public function forgottenPassword() : void
    {
        $data = [];
        $template = $this->template.'forgottenPassword.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function changePassword(array $formData) : void
    {
        $users = $this->userManager->getUsers();
        if ($formData['identifiant'] === $users[0]['username']) {
            header('Location: index.php?action=new_password');
            exit;
        }

        echo 'Utilisateur inconnu';
    }

    public function newPassword() : void
    {
        $data = [];
        $template = $this->template.'newPassword.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function updatePassword(array $formData) : void
    {
        $hashedPassword = password_hash($formData['password'], PASSWORD_DEFAULT);
        $this->userManager->updatePassword($hashedPassword);
        echo 'votre mot de passe a bien été modifié';
    }

    public function logOut() : void
    {
        $this->session->endSession();
        header('Location: index.php');
        exit;
    }

}