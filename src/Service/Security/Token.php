<?php

declare(strict_types=1);

namespace App\Service\Security;
use App\Service\Http\Session;

class Token
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;        
    }

    public function setToken() : void
    {
        //On génère une chaine de 50 caracctères aléatoire
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $string = '';
        $stringLength = 49;

        for ($i = 0; $i <= $stringLength; $i++) {
            $string = $string.$characters[rand(0, strlen($characters) - 1)];
        }

        //On hash la chaine pour obtenir le token
        $token = password_hash($string, PASSWORD_BCRYPT);
        $this->session->setToken($token);
    }
}