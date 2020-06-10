<?php
declare(strict_types=1);

namespace App\Service;

use App\Service\Database;
use App\Model\PostManager;
use App\Controller\PostController;
use App\View\View;

class Router {

    public function __construct() {
        // les dépendances du Router
        // injection des dépendances
        $this->database = new Database();
        $this->postManager = new PostManager($this->database);
        $this->view = new View();
        $this->postController = new PostController($this->postManager, $this->view);

        $this->get = $_GET;
    }

    public function run(): void {
        
        if (isset($this->get['action']) && isset($this->get['id']) && $this->get['action'] === 'post') {
            $this->postController->displayOneEpisode((int)$this->get['id']);
        }
        else {
            echo "Action non définie ou non égale à 'post' ou id non défini";
        }
    }
}