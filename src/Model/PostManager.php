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
        $episodes = $this->database->prepare("SELECT *, DATE_FORMAT(episode_date, '%d/%m/%Y - %H:%i:%s') AS episode_date 
            FROM episodes 
            WHERE episode_id = :id");
        $episodes->bindParam(':id', $id);
        $episodes->execute();
        return $episodes->fetchAll();
    }

    public function getPreviousPost(int $numeroEpisode) : array
    {
        $previousEpisode = $this->database->prepare("SELECT *,  DATE_FORMAT(episode_date, '%d/%m/%Y - %H:%i:%s') AS episode_date
            FROM episodes
            WHERE numero_episode = :episode");
        $previousEpisode->bindParam(':episode', $numeroEpisode);
        $previousEpisode->execute();
        return $previousEpisode->fetchAll();
    }

    public function getNextPost(int $numeroEpisode) : array
    {
        $nextEpisode = $this->database->prepare("SELECT *,  DATE_FORMAT(episode_date, '%d/%m/%Y - %H:%i:%s') AS episode_date
            FROM episodes
            WHERE numero_episode = :episode");
        $nextEpisode->bindParam(':episode', $numeroEpisode);
        $nextEpisode->execute();
        return $nextEpisode->fetchAll();
    }

    public function getThreeEpisodes() : array
    {
        $request = $this->database->prepare("SELECT *, substring(episode_content, 1, 500) AS episode_content, DATE_FORMAT(episode_date, '%d/%m/%Y - %H:%i:%s') AS episode_date
            FROM episodes
            ORDER BY numero_episode
            DESC LIMIT 0, 3");
        $request->execute();
      
        return $request->fetchAll();
    }

    public function getNumberOfEpisodes() : int
    {
        $request = $this->database->prepare("SELECT numero_episode FROM episodes");
        $request->execute();
        return count($request->fetchALl());
    }

    public function getAllEpisodes(int $offset) : array
    {
        $request = $this->database->prepare("SELECT *, substring(episode_content, 1, 500) AS episode_content, 
            DATE_FORMAT(episode_date, '%d/%m/%Y - %H:%i:%s') AS episode_date
            FROM episodes
            ORDER BY numero_episode
            LIMIT 3 OFFSET :beginning");

        $request->bindParam(':beginning', $offset, \PDO::PARAM_INT);
        $request->execute();

        return $request->fetchAll();
    }

    public function backPostList() : array
    {
        $request = $this->database->prepare('SELECT * FROM episodes ORDER BY numero_episode');
        $request->execute();

        return $request->fetchAll();
    }

    public function testBeforeSave($episode) : bool
    {
        $test = $this->database->prepare("SELECT numero_episode 
            FROM episodes
            WHERE numero_episode = :episode_to_publish");

        $test->bindParam(':episode_to_publish', $episode);
        $test->execute();
        $results = $test->fetchAll();

        if (isset($results[0]['numero_episode'])) {
            return true;
        }
        elseif (empty($results)) {
            return false;
        }
    }

    public function saveEpisode(int $numeroEpisode, string $title, string $content) : void
    {
        //on insère le nouveau post dans la table et on le publie
        $saveEpisode = $this->database->prepare('INSERT INTO episodes (numero_episode, episode_title, episode_content) 
            VALUES (:numeroEpisode, :title, :content)');
        $saveEpisode->bindParam(':numeroEpisode', $numeroEpisode);
        $saveEpisode->bindParam(':title', $title);
        $saveEpisode->bindParam(':content', $content);

        $saveEpisode->execute();
    }

    public function overwriteEpisode(int $id, int $episode, string $title, string $content) : void
    {
        //on ecrase l'ancien épisode avec le nouveau
        $overwrite = $this->database->prepare('UPDATE episodes 
            SET numero_episode = :newEpisodeNumber, episode_title = :newTitle, episode_content = :newContent 
            WHERE episode_id = :id');
        $overwrite->bindparam(':newEpisodeNumber', $episode);
        $overwrite->bindparam(':newTitle', $title);
        $overwrite->bindparam(':newContent', $content);
        $overwrite->bindparam(':id', $id);

        $overwrite->execute();
    }

    public function deleteEpisode(int $id) : void
    {
        $delete = $this->database->prepare('DELETE FROM episodes WHERE episode_id = :id');
        $delete->bindParam(':id', $id);

        $delete->execute();
    }
}