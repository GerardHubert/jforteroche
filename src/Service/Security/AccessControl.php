<?php
declare(strict_types=1);

namespace App\Service\Security;

use App\Service\Http\Session;

class AccessControl
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
        $this->session->getSessionData();
    }
}