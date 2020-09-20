<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\View\View;
use App\Service\Http\Session;

class ErrorController
{
    private $view;
    private $layout;
    private $session;
    
    public function __construct(View $view, Session $session)
    {
        $this->view = $view;
        $this->session = $session;
        $this->layout = '../templates/frontOffice/layout.html.php';
    }

    public function displayError() : void
    {
        $data = [];
        $template = 'error.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}