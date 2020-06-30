<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\{PostManager, CommentManager};
use App\View\View;

class PostController
{
    private $postManager;
    private $commentManager;
    private $view;

    public function __construct(PostManager $postManager, View $view, CommentManager $commentManager)
    {
        $this->postManager = $postManager;
        $this->view = $view;
        $this->commentManager = $commentManager;
    }

    public function displayOneEpisode(int $id) : void 
    {
        //fonction pour afficher un épisode selon l'id transmis par le router
        //on passe l'id au model pour récupérer les infos
        //on appelle la bonne vue
        $episodeData = $this->postManager->getOneEpisode($id);
        $commentsData = $this->commentManager->getComments($id);
        $data = [$episodeData, $commentsData];
        
        if (empty($data)) {
            header('Location: index.php?action=error');
            exit;
        }
        $template = "/wamp64/www/projets/jforteroche/templates/frontOffice/onepost.html.php";
        $this->view->display(['episode' => $data[0][0], 'comments' => $data[1]], $template);
    }

    public function displayHome() : void
    {
        //pour afficher les 3 derniers posts
        $data = $this->postManager->getThreeEpisodes();
        $template = '/wamp64/www/projets/jforteroche/templates/frontOffice/home.html.php';
        $this->view->display($data, $template);
    }

    public function displayAllPosts() : void
    {
        $data = $this->postManager->getAllEpisodes();
        $template = '/wamp64/www/projets/jforteroche/templates/frontOffice/allposts.html.php';
        $this->view->display($data, $template);
    }
}