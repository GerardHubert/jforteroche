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

    public function __construct(LogManager $logManager, View $view)
    {
        $this->logManager = $logManager;
        $this->view = $view;
        $this->layout = '../templates/backOffice/layout.html.php';
    }

    public function login() : void
    {
        $data = [];
        $template = "../templates/backoffice/login.html.php";
        $this->view->display($data, $template, $this->layout);
    }
}