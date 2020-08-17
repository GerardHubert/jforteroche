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
        //sauvegarde du brouillon dans la table drafts
        $saveDraft = $this->database->prepare('INSERT INTO drafts (episode, draft_title, draft_content) VALUES (:episode, :title, :content)');
        $saveDraft->bindParam(':episode', $episode);
        $saveDraft->bindParam(':title', $title);
        $saveDraft->bindParam(':content', $content);

        $saveDraft->execute();
    }

    public function testBeforeSave($episode) : bool
    {
        $test = $this->database->prepare('SELECT episode FROM drafts WHERE episode = :draftToInsert');
        $test->bindParam(':draftToInsert', $episode);
        $test->execute();
        $array = $test->fetchAll();
        
        if (isset($array[0]['episode'])) {
            return true;
        }

        return false;
       
    }

    public function getDrafts() : array
    {
        //récupérer les brouillons de la table drafts
        $getDrafts = $this->database->prepare('SELECT * FROM drafts');
        $getDrafts->execute();
        return $getDrafts->fetchAll();
    }

    public function getOneDraft(int $episode) : array
    {
        //on récupère les données d'un brouillon
        $getOneDraft = $this->database->prepare('SELECT * FROM drafts WHERE episode = :episode');
        $getOneDraft->bindParam(':episode', $episode);
        $getOneDraft->execute();
        return $getOneDraft->fetchAll();
    }

    public function overwriteDraft(int $id, int $episode, string $title, string $content) : void
    {
        $overwriteDraft = $this->database->prepare('UPDATE drafts SET episode = :newEpisode, draft_title = :newTitle, draft_content = :newContent WHERE draft_id = :id');
        $overwriteDraft->bindParam(':newEpisode', $episode);
        $overwriteDraft->bindParam(':newTitle', $title);
        $overwriteDraft->bindParam(':newContent', $content);
        $overwriteDraft->bindParam(':id', $id);

        $overwriteDraft->execute();
    }

    public function delete(int $episode) : void
    {
        $deleteDraft = $this->database->prepare('DELETE FROM drafts WHERE episode = :episode');
        $deleteDraft->bindParam(':episode', $episode);
        $deleteDraft->execute();
    }
}