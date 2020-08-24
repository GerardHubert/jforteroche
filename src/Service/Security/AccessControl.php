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

    public function authentification() : void
    {
        $data = [];
        $template = $this->template.'logInPage.html.php';
        $this->view->display($data, $template, $this->layout);
    }

    public function newUser(array $formData) : void
    {
        $user = $formData['identifiant'];
        $pass = $formData['password'];

        //On vérifie qu'un même user n'existe pas déjà dans la table
        $check = $this->logManager->checkUser($user);

        //Puis on enregistre ou redirige vers message erreur
        switch ($check) {
            case false:
                $cryptedPassword = password_hash($pass, PASSWORD_DEFAULT);
                $this->logManager->saveNewUser($user, $cryptedPassword);
                header('Location: index.php?action=authentification');
                exit;
            break;

            case true:
                echo 'Un utilisateur du même nom existe déjà !';
            break;
        }
    }

    public function logIn(array $formData) : void
    {
        //récupération id et mot de passe saisis
        $user = $formData['identifiant'];
        $pass = $formData['password'];

        //On vérifie que le user existe dans la table
        $userExists = $this->logManager->checkUser($user);

        if ($userExists === true) {
            $hash = $this->logManager->getHashedPass($user);
        
            switch (password_verify($pass, $hash)) {
                case true:
                    header('Location: index.php?action=backoffice');
                    exit;
                break;

                case false:
                    echo 'le mot de passe est incorrect <br/>';
                break;
            }
        }
        elseif ($userExists === false) {
            echo 'utilisateur non trouvé <br/>';
        }
    }

    public function logOut() : void
    {
        
    }
}