<?php
declare(strict_types=1);

namespace App\Model;

use App\Controller\PostController;
use App\Service\Database;

class PostManager {

    public function __construct(Database $database){
        //objet Database en paramètre pour récupérer la connection
        $this->database = $database->databaseConnect();
    }

    public function getOneEpisode(int $id) {
        //selon l'id transmis par postController, on requete la database
        //pour obtenir les infos concernat 1 épisode
        //retourner les data au postController
        $this->request = $this->database->query("SELECT * FROM episodes WHERE episode_id = $id");

        while($this->data = $this->request->fetch()) {
            $episodeId = ($this->data['episode_id']);
            $episodeTitle = ($this->data['episode_title']);
            $episodeContent = ($this->data['episode_content']);
        }

        $post = ['id' => $episodeId, 'title' => $episodeTitle, 'content' => $episodeContent];
        return $post;
    }
}