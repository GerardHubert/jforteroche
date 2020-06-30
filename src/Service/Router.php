<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\{PostManager, CommentManager};
use App\View\View;
use App\Controller\{CommentController, ErrorController, PostController};

class Router
{
    private $database;
    private $postManager;
    private $commentManager;
    private $postController;
    private $commentController;
    private $errorController;
    private $view;
    private $get;
    private $post;

    public function __construct()
    {
        // les dépendances du Router
        // injection des dépendances
        $this->database = new Database();
        $this->postManager = new PostManager($this->database);
        $this->commentManager = new CommentManager($this->database);
        $this->view = new View();
        $this->postController = new PostController($this->postManager, $this->view, $this->commentManager);
        $this->commentController = new CommentController($this->commentManager, $this->view);
        $this->errorController = new ErrorController($this->view);

        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function run(): void
    {
        $getAllAction = isset($this->get['action']) && $this->get['action'] === 'get_all';
        $getPostAction = isset($this->get['action'], $this->get['id']) && $this->get['action'] === 'post';
        $getHomeAction = empty($this->get);
        $getErrorAction = isset($this->get['action']) && $this->get['action'] === 'error';

        if ($getErrorAction) {
            //Route: http://localhost/projets/jforteroche/public/index.php?action=error
            //On affiche une page d'erreur

            $this->errorController->displayError();
        }

        elseif ($getPostAction) {
            //Route: http://localhost/projets/jforteroche/public/index.php?action=post&id=[id de l'épisode choisi]
            //affiche 1 post + commentaires associés

            $this->postController->displayOneEpisode((int) $this->get['id']);
        }

        elseif ($getAllAction) {
            //Route: http://localhost/projets/jforteroche/public/index.php?action=get_all
            //affiche la liste de tous les épisodes

            $this->postController->displayAllPosts();
        }
        elseif ($getHomeAction) {
            //Route: http://localhost/projets/jforteroche/public/index.php
            //affiche la page d'accueil avec les 3 derniers posts
            $this->postController->displayHome();
        }
    }
}