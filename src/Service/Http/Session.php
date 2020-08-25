<?php
declare(strict_types=1);

namespace App\Service\Http;

class Session
{
    private $session;

    public function __construct()
    {
        $this->session = $_SESSION;
    }

}