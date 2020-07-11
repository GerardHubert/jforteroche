<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class DraftManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database->databaseConnect();
    }

    public function saveDraft(string $title, string $content) : void
    {
        //sauvegarde du brouillon dans la table drafts
        $saveDraft = $this->database->prepare('INSERT INTO drafts (draft_title, draft_content) VALUES (:title, :content)');
        $saveDraft->bindParam(':title', $title);
        $saveDraft->bindParam(':content', $content);

        $saveDraft->execute();
    }

    public function getDrafts() : array
    {
        //récupérer les brouillons de la table drafts
        $getDrafts = $this->database->prepare('SELECT * FROM drafts');
        $getDrafts->execute();
        return $getDrafts->fetchAll();
    }

    public function getOneDraft(int $draftId) : array
    {
        //on récupère les données d'un brouillon
        $getOneDraft = $this->database->prepare('SELECT * FROM drafts WHERE draft_id = :id');
        $getOneDraft->bindParam(':id', $draftId);
        $getOneDraft->execute();
        return $getOneDraft->fetchAll();
    }

    public function overwriteDraft(int $id, int $episode, string $title, string $content) : void
    {
        $overwriteDraft = $this->database->prepare('UPDATE drafts SET episode = :nouvelId, draft_title = :newTitle, draft_content = :newContent WHERE draft_id = :id');
        $overwriteDraft->bindParam(':nouvelId', $episode);
        $overwriteDraft->bindParam(':newTitle', $title);
        $overwriteDraft->bindParam(':newContent', $content);
        $overwriteDraft->bindParam(':id', $id);

        $overwriteDraft->execute();
    }

    public function delete(int $id) : void
    {
        $deleteDraft = $this->database->prepare('DELETE FROM drafts WHERE draft_id = :id');
        $deleteDraft->bindParam(':id', $id);
        $deleteDraft->execute();
    }
}