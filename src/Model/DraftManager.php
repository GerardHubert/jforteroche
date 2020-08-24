<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class DraftManager
{
    private $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function saveDraft(int $episode, string $title, string $content) : void
    {
        //sauvegarde dans la table episodes, avec status brouillon
        $saveDraft = $this->database->prepare("INSERT INTO episodes (numero_episode, episode_title, episode_content, episode_status)
            VALUES (:episode, :title, :content, 0)");
        $saveDraft->bindParam(':episode', $episode);
        $saveDraft->bindParam(':title', $title);
        $saveDraft->bindParam(':content', $content);
        $saveDraft->execute();
    }

    public function testBeforeSave(int $episode) : bool
    {
        /*$test = $this->database->prepare('SELECT episode FROM drafts WHERE episode = :draftToInsert');
        $test->bindParam(':draftToInsert', $episode);
        $test->execute();
        $array = $test->fetchAll();
        
        if (isset($array[0]['episode'])) {
            return true;
        }

        return false;*/

        $test = $this->database->prepare('SELECT episode_status FROM episodes WHERE numero_episode = :episode');
        $test->bindParam(':episode', $episode);
        $test->execute();
        $result = $test->fetchAll();

        if (isset($result[0]['episode_status'])) {
            return true;
        }

        return false;
       
    }

    public function getDrafts() : array
    {
        //récupérer les brouillons de la table episodes
        $getDrafts = $this->database->prepare('SELECT * FROM episodes WHERE episode_status = 0');
        $getDrafts->execute();
        return $getDrafts->fetchAll();
    }

    public function getOneDraft(int $episode) : array
    {
        //on récupère les données d'un brouillon
        $getOneDraft = $this->database->prepare('SELECT * FROM episodes WHERE numero_episode = :episode');
        $getOneDraft->bindParam(':episode', $episode);
        $getOneDraft->execute();
        return $getOneDraft->fetchAll();
    }

    public function overwriteDraft(int $id, int $episode, string $title, string $content) : void
    {
        $overwriteDraft = $this->database->prepare('UPDATE episodes
            SET numero_episode = :newEpisode, episode_title = :newTitle, episode_content = :newContent 
            WHERE episode_id = :id');
        $overwriteDraft->bindParam(':newEpisode', $episode);
        $overwriteDraft->bindParam(':newTitle', $title);
        $overwriteDraft->bindParam(':newContent', $content);
        $overwriteDraft->bindParam(':id', $id);

        $overwriteDraft->execute();
    }

    public function delete(int $episode) : void
    {
        $deleteDraft = $this->database->prepare('DELETE FROM episodes WHERE numero_episode = :episode');
        $deleteDraft->bindParam(':episode', $episode);
        $deleteDraft->execute();
    }
}