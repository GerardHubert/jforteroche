<?php
declare(strict_types=1);

namespace App\Model;

use App\Controller\PostController;
use App\Service\Database;

class PostManager 
{
    private $database;

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
        $episodeRequest = $this->database->prepare("SELECT * FROM episodes WHERE episode_id = :episode_id");
        $episodeRequest->bindParam(':episode_id', $id);

        $commentsRequest = $this->database->prepare("SELECT * FROM commentaires WHERE episode = :episode ORDER BY comment_date DESC");
        $commentsRequest->bindParam(':episode', $id);

        $episodeRequest->execute();
        $commentsRequest->execute();

        return array($episodeRequest->fetchAll(), $commentsRequest->fetchAll());
    }

    public function getThreeEpisodes()
    {
        $request = $this->database->prepare("SELECT * FROM episodes ORDER BY episode_id DESC LIMIT 0, 3 ");
        $request->execute();
      
        return $request->fetchAll();
    }
}