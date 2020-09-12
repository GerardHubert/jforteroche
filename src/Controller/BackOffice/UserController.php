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
    private $session;

    public function __construct(UserManager $userManager, View $view, Session $session)
    {
        $this->userManager = $userManager;
        $this->session = $session;
        $this->view = $view;
        $this->layout = '../templates/authentification/layout.html.php';
    }

    public function authentification() : void
    {
        $data = [];
        $template = 'logInPage.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function logIn(array $formData) : void
    {
        $pass = $formData['password'];
        $user = $this->userManager->getUser($formData['identifiant']);
        $message = "Nom d'utilisateur ou mot de passe incorrect";

        //on cherche si le username saisi existe dans la table users
        if (isset($user[0]['username']) && $user[0]['username'] === $formData['identifiant']) {
            switch (password_verify($pass, $user[0]['pass'])) {
                case true:
                    //on transmet à la classe session les variables à enregistrer
                    //puis on redirige vers le backoffice
                    $this->session->setUserName($user[0]['username']);
                    if(!empty($this->session->getFlashMessage())){
                        $this->session->deleteFlashMessage();
                    }
                    header('Location: index.php?action=episodes_list');
                    exit;
                break;

                    //sinon, on renvoie un message d'erreur
                case false:
                    $this->session->setFlashMessage($message);
                    header('Location: index.php?action=authentification');
                    exit;
                    //echo 'mot de passe incorrect';
                break;
            }
        }
        elseif (empty($user[0]['username'])) {
            $this->session->setFlashMessage($message);
            header('Location: index.php?action=authentification');
            exit;
        }
    }

    public function userPage() : void
    {
        //méthode pour afficher la page de config utilisateur
        $data = [];
        $template = 'userSpace.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function changeUsername(array $formData) : void
    {
        if (empty($formData)) {
            $data = [];
            $template = 'changeUSername.html.php';
            $this->view->display($data, $template, $this->layout);
        }

        elseif (!empty($formData)) {
            if ($formData['new_username'] === $formData['confirm_username']) {
                $this->userManager->updateUsername($formData['new_username']);
                $this->session->endSession();
                header('Location: index.php?action=authentification');
                exit;
            }

            elseif ($formData['new_username'] !== $formData['confirm_username']) {
                echo '<br/> Les usernames ne correspondent pas !';
            }
        }
    }

    public function changePassword(array $formData) : void
    {
        if (empty($formData)) {
            $data = [];
            $template = 'changePassword.html.php';
            $this->view->display($data, $template, $this->layout);
        }

        elseif (!empty($formData)) {
            if ($formData['new_password'] === $formData['confirm_password']) {
                $this->userManager->updatePassword(password_hash($formData['new_password'], PASSWORD_BCRYPT));
                $this->session->endSession();
                header('Location: index.php?action=authentification');
                exit;
            }
            
            elseif ($formData['new_password'] !== $formData['confirm_password']) {
                echo '<br/> Les mots de passe ne correspondent pas !';
            }
        }

    }

    /*public function forgottenPassword() : void
    {
        $data = [];
        $template = 'forgottenPassword.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function changePassword(array $formData) : void
    {
        $message = "Nom d'utilisateur inconnu";
        $this->session->setFlashMessage($message);
        $users = $this->userManager->getUser($formData['identifiant']);
        if ($formData['identifiant'] === $users['username']) {
            header('Location: index.php?action=new_password');
            exit;
        }

        header('Location: index.php?action=forgotten_password');
        exit;
    }

    public function newPassword() : void
    {
        $data = [];
        $template = 'newPassword.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function updatePassword(array $formData) : void
    {
        $hashedPassword = password_hash($formData['password'], PASSWORD_BCRYPT);
        $this->userManager->updatePassword($hashedPassword);
        echo 'votre mot de passe a bien été modifié';
        //header('Location: index.php?action=authentification');
        exit;
    }*/

    public function logOut() : void
    {
        $this->session->endSession();
        header('Location: index.php');
        exit;
    }
}