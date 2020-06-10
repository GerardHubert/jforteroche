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
        //selon l'id transmis par postController, non requete la database
        //pour obtenir les infos concernat 1 épisode
        //retourner les data au postController
        $this->request = $this->database->query("SELECT * FROM episodes WHERE episode_id = $id");

        while($this->data = $this->request->fetch()) {
            var_dump ($this->data['episode_id']);
            var_dump ($this->data['episode_title']);
        }
    }
}