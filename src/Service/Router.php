<?php
declare(strict_types=1);

namespace App\Service;

use App\Controller\PostController;

class Router {

    public function __construct() {
        // les dépendances du Router
        // injection des dépendances

        $this->get = $_GET;
    }

    public function run(): void {
        
        if (isset($this->get['action']) && isset($this->get['id']) && $this->get['action'] === 'post') {
            $this->postController->displayOneEpisode($this->get['id']);
        }
        else {
            echo "Action non définie ou non égale à 'post' ou id non défini";
        }
    }
}