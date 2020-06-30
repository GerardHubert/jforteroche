<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class CommentManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database->databaseConnect();
    }

    public function getComments(int $id)
    {
        $comments = $this->database->prepare('SELECT * FROM commentaires WHERE episode = :id ORDER BY comment_date DESC LIMIT 0, 10');
        $comments->bindParam(':id', $id);
        $comments->execute();
        return $comments->fetchAll();
    }

    public function postComment(int $id, string $pseudo, string $comment) : void
    {
        $postComment = $this->database->prepare('INSERT INTO commentaires (episode, pseudo, comment) VALUES (:episode, :pseudo, :comment)');
        $postComment->bindParam(':episode', $id);
        $postComment->bindParam(':pseudo', $pseudo);
        $postComment->bindParam(':comment', $comment);

        $postComment->execute();
    }
}