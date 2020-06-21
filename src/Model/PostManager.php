<?php
declare(strict_types=1);

namespace App\Model;

use App\Controller\PostController;
use App\Service\Database;

class PostManager 
{

    public function __construct(Database $database)
    {
        //objet Database en paramètre pour récupérer la connection
        $this->database = $database->databaseConnect();
    }

    public function getOneEpisode(int $id)
    {
        //selon l'id transmis par postController, on requete la database
        //pour obtenir les infos concernat 1 épisode
        //retourner les data au postController
        $request = $this->database->prepare("SELECT * FROM episodes WHERE episode_id = ?");
        $request->bindParam(1, $id);
        $request->execute();
        $data = $request->fetchAll();
        return $data;
    }

    public function getThreeEpisodes()
    {
        $request = $this->database->prepare("SELECT * FROM episodes ORDER BY episode_id DESC LIMIT 0, 3 ");
        $request->execute();
        /*$post = [];
        while($data = $request->fetch()) {
            $episodeId = $data['episode_id'];
            $episodeTitle = $data['episode_title'];
            $episodeContent = ($data['episode_content']);
            array_push($post, ['id' => $episodeId, 'title' => $episodeTitle, 'content' => $episodeContent]);
        }*/
        $data = $request->fetchAll();
        return $data;

    }
}