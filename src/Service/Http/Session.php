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