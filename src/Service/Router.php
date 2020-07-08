<?php
declare(strict_types=1);

namespace App\Service;

use App\Model\{PostManager, CommentManager, LogManager};
use App\View\View;
use App\Controller\FrontOffice\{CommentController, ErrorController, PostController};
use App\Service\Security\AccessControl;

class Router
{
    private $database;
    private $postManager;
    private $commentManager;
    private $postController;
    private $commentController;
    private $errorController;
    private $logManager;
    private $accessControl;
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
        $this->commentController = new CommentController($this->commentManager);
        $this->errorController = new ErrorController($this->view);
        $this->logManager = new LogManager($this->database);
        $this->accessControl = new AccessControl($this->logManager, $this->view);
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function run(): void
    {
        if (empty($this->get)) {
            //Route: index.php?action=get_home
            //affiche la page d'accueil avec les 3 derniers posts
            $this->postController->displayHome();
        }
        elseif (isset($this->get['action'])) {
            switch ($this->get['action']) {
                case 'error':
                    //Route: index.php?action=error
                    //On affiche une page d'erreur
                    $this->errorController->displayError();
                break;

                case 'get_all':
                    //Route: index.php?action=get_all
                    //affiche la liste de tous les épisodes
                    $this->postController->displayAllPosts();
                break;

                case 'post':
                    //Route: index.php?action=post&id=[id de l'épisode choisi]
                    //affiche 1 post + commentaires associés
                    $this->postController->displayOneEpisode((int) $this->get['id']);
                break;

                case 'save_com':
                    //Route: index.php?action=save_com
                    //sauvegarde du commentaire en passant au commentController les éléments du formulaires
                    $this->commentController->saveComment((int) $this->get['id'], $this->post['pseudo'], $this->post['comment']);
                break;

                case 'signal':
                    //Route: index.php?action=signal&comment_id=[id du commentaire signalé]
                    //on prend en compte le signalement du commentaire
                    $this->commentController->reportComment((int) $this->get['comment_id'], (int) $this->get['id']);
                break;

                case 'login':
                    //Route: index.php?action=login
                    $this->accessControl->login();
                break;
            }
        }
    }
}