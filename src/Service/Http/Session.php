<?php
declare(strict_types=1);

namespace App\Service\Http;
use App\Service\Security\AccessControl;

class Session
{
    private $session;

    public function __construct()
    {
        session_start();
        $this->session = $_SESSION;
    }

    public function setUserName(string $username) : void
    {
        $_SESSION['username'] = $username;
    }

    public function setFlashMessage(string $message) : void
    {
        $_SESSION['authentificationMessage'] = $message;
    }

    public function deleteFlashMessage()
    {
        unset($_SESSION['authentificationMessage']);
    }

    public function setToken($token) : void
    {
        $_SESSION['token'] = $token;
    }

    public function getToken() : string
    {
        if (isset($_SESSION['token'])) {
            return $_SESSION['token'];
        }
        return '';
    }

    public function getFlashMessage() : string
    {
        if (isset($this->session['authentificationMessage'])) {
            return $this->session['authentificationMessage'];
        }
        return '';
    }

    public function getUserName() : string
    {
        if (isset($this->session['username'])) {
            return $this->session['username'];
        }
        return '';
    }

    public function endSession() : void
    {
        session_unset();
        session_destroy();
    }

}