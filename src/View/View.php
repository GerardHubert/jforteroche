<?php
declare(strict_types=1);

namespace App\View;
use App\Service\Http\Session;
use App\Service\Security\AccessControl;

class View
{
    private $session;
    private $accessControl;

    public function __construct(Session $session, AccessControl $accessControl)
    {
        $this->session = $session;
        $this->accessControl = $accessControl;
        
    }
    public function display(array $data, string $template, string $layout) : void
    {
        ob_start();
        require_once($template);
        $content = ob_get_clean();
        require_once($layout);
    }
}