<?php
declare(strict_types=1);

namespace App\Service\Security;

use App\Service\Http\Session;

class AccessControl
{
    private $session;
    private $sessionVar;

    public function __construct(Session $session)
    {
        $this->session = $session;
        //$this->sessionVar = $this->session->getUsername();
    }

    public function isConnected() : bool
    {   
        $test = $this->session->getUserName();
        if (!empty($test) && isset($test)) {
            return true;
        }
        return false;
    }

    public function getUserName() : string
    {
        return $this->session->getUserName();
    }
}