<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\{PostManager, CommentManager};
use App\View\View;
use App\Controller\{CommentController, ErrorController, PostController};

class Router
{

    public function __construct()
    {
        // les dépendances du Router
        // injection des dépendances
        $this->database = new Database();
        $this->postManager = new PostManager($this->database);
        $this->commentManager = new CommentManager($this->database);
        $this->view = new View();
        $this->postController = new PostController($this->postManager, $this->view);
        $this->commentController = new CommentController($this->commentManager, $this->view);
        $this->errorController = new ErrorController($this->view);

        $this->get = $_GET;
    }

    public function run(): void
    {
        $test = isset($this->get['action'], $this->get['id']);

        if ($test && $this->get['action'] === 'post') {
            $this->postController->displayOneEpisode((int)$this->get['id']);
            $this->commentController->displayComments((int)$this->get['id']);
        }
        else {
            $this->postController->displayHome();
        }
    }
}