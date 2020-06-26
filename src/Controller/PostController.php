<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\PostManager;
use App\View\View;

class PostController
{
    private $postManager;
    private $view;

    public function __construct(PostManager $postManager, View $view)
    {
        $this->postManager = $postManager;
        $this->view = $view;
    }

    public function displayOneEpisode(int $id) : void 
    {
        //fonction pour afficher un épisode selon l'id transmis par le router
        //on passe l'id au model pour récupérer les infos
        //on appelle la bonne vue
        $data = $this->postManager->getOneEpisode($id);
        if (empty($data)) {
            header('Location: index.php?action=error');
            exit;
        }

        $this->view->display(['episode' => $data[0], 'comments' => $data[1]]);
    }

    public function displayHome() : void
    {
        //pour afficher les 3 derniers posts
        $data = $this->postManager->getThreeEpisodes();
        $this->view->display(['home' => $data]);
    }
}