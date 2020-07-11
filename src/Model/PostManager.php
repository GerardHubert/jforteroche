<?php
declare(strict_types=1);

namespace App\Model;

use App\Controller\FrontOffice\PostController;
use App\Service\Database;

class PostManager 
{
    private $database;

    public function __construct(Database $database)
    {
        //objet Database en paramètre pour récupérer la connection
        $this->database = $database->databaseConnect();
    }

    public function getOneEpisode(int $id) : array
    {
        //selon l'id transmis par postController, on requete la database
        //pour obtenir les infos concernat 1 épisode
        //retourner les data au postController
        $episodes = $this->database->prepare("SELECT * FROM episodes WHERE episode_id = :episode_id");
        $episodes->bindParam(':episode_id', $id);

        $episodes->execute();
        return $episodes->fetchAll();
    }

    public function getThreeEpisodes() : array
    {
        $request = $this->database->prepare("SELECT * FROM episodes ORDER BY episode_id DESC LIMIT 0, 3 ");
        $request->execute();
      
        return $request->fetchAll();
    }

    public function getAllEpisodes() : array
    {
        $request = $this->database->prepare('SELECT * FROM episodes ORDER BY episode_id DESC');
        $request->execute();

        return $request->fetchAll();
    }

    public function saveEpisode(string $title, string $content) : void
    {
        //on insère le nouveau post dans la table et on le publie
        $saveEpisode = $this->database->prepare('INSERT INTO episodes (episode_title, episode_content) VALUES (:title, :content)');
        $saveEpisode->bindParam(':title', $title);
        $saveEpisode->bindParam(':content', $content);

        $saveEpisode->execute();
    }
}