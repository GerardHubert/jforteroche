<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\PostManager;
use App\View\View;

class PostController {

    public function __construct(PostManager $postManager, View $view) {
        $this->postManager = $postManager;
        $this->view = $view;
    }

    public function displayOneEpisode(int $id) {
        //fonnction pour afficher un épisode selon l'id transmis par le router
        //on passe l'id au model pour récupérer les infos
        //on appelle la bonne vue
        $data = $this->postManager->getOneEpisode($id);
        $this->view->display(['onepost' => $data]);
    }
}