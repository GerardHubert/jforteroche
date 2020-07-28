<?php
declare(strict_types=1);

namespace App\Controller\FrontOffice;

use App\View\View;

class ErrorController
{
    private $view;
    private $layout;
    
    public function __construct(View $view)
    {
        $this->view = $view;
        $this->layout = '../templates/frontOffice/layout.html.php';
    }

    public function displayError() : void
    {
        $data = [];
        $template = '../templates/frontOffice/error.html.php';
        $this->view->display($data, $template, $this->layout);
    }
}