<?php
declare(strict_types=1);

namespace App\Controller;

use App\Model\PostManager;

class PostController {

    public function __construct(PostManager $postManager) {
        $this->postManager = $postManager;
    }

    public function displayOneEpisode(int $id) {
        //fonnction pour afficher un épisode selon l'id transmis par le router
        //on passe l'id au model pour récupérer les infos
        //on appelle la bonne vue
        $this->postManager->getOneEpisode($id);
    }
}