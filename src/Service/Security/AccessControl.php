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
        $this->sessionVar = $this->session->getSessionVar();
    }

    public function isConnected() : bool
    {
        if (isset($this->sessionVar['username'])) {
            return true;
        }
        return false;
    }
}