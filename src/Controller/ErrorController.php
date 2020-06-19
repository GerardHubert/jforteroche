<?php
declare(strict_types = 1);

namespace App\Controller;

use App\View\View;

class ErrorController
{
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function displayError() : void
    {
        //appeler la vue pour afficher l'erreur ici
    }
}