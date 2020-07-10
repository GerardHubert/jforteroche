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
        $this->layout = '../templates/backOffice/layout.html.php';
        $this->template = '../templates/backOffice/';
    }

    public function login() : void
    {
        $data = [];
        $template = $this->template.'home.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}