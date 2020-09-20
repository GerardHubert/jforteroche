<?php
declare(strict_types=1);

namespace App\Controller\BackOffice;

use App\Model\UserManager;
use App\View\View;
use App\Service\Http\Session;
use App\Service\Security\{AccessControl, Token};

class UserController
{
    private $userManager;
    private $view;
    private $layout;
    private $session;
    private $accessControl;
    private $token;

    public function __construct(UserManager $userManager, View $view, Session $session, AccessControl $accessControl, Token $token)
    {
        $this->userManager = $userManager;
        $this->session = $session;
        $this->view = $view;
        $this->accessControl = $accessControl;
        $this->token = $token;  
        $this->layout = '../templates/authentification/layout.html.php';
    }

    public function access() : void
    {
        if ($this->accessControl->isConnected() ===  false) {
            header('Location: index.php?action=authentification');
        }
    }

    public function authentification() : void
    {
        $this->token->setToken();
        $data = [];
        $template = 'logInPage.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function logIn(array $formData) : void
    {
        $this->access();
        $pass = $formData['password'];
        $user = $this->userManager->getUser($formData['identifiant']);
        $message = "Nom d'utilisateur ou mot de passe incorrect";

        if ($this->session->getToken() !== $formData['hidden_input']) {
            $this->session->setFlashMessage('Vous ne disposez pas des droits requis');
            header('Location: index.php?action=authentification');
            exit;
        }
        elseif ($this->session->getToken() === $formData['hidden_input']) {
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
                    break;
                }
            }
            elseif (empty($user[0]['username'])) {
                $this->session->setFlashMessage($message);
                header('Location: index.php?action=authentification');
                exit;
            }
        }
    }

    public function userPage() : void
    {
        $this->access();
        //méthode pour afficher la page de config utilisateur
        $data = [];
        $template = 'userSpace.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function changeUsername(array $formData) : void
    {
        $this->access();
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
                $this->session->setFlashMessage('Les noms utilisateurs ne sorrespondent pas !');
                header('Location : index.php?action=change_username');
                exit;
            }
        }
    }

    public function changePassword(array $formData) : void
    {
        $this->access();
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
                $this->session->setFlashMessage('Les mots de passe ne correspondent pas !');
                header('Location: index.php?action=change_password');
                exit;
            }
        }

    }

    public function logOut() : void
    {
        $this->session->endSession();
        header('Location: index.php');
        exit;
    }
}