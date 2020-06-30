<?php
declare(strict_types = 1);

namespace App\Controller;

use App\View\View;

class ErrorController
{
    private $view;
    
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function displayError() : void
    {
        $data = [];
        $template = '/wamp64/www/projets/jforteroche/templates/frontOffice/error.html.php';
        $this->view->display($data, $template);
    }
}