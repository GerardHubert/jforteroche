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

    public function getComments(int $id) : array
    {
        $comments = $this->database->prepare("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y - %H:%i:%s') AS comment_date
            FROM commentaires WHERE episode = :id
            ORDER BY comment_date 
            DESC LIMIT 0, 10");
        $comments->bindParam(':id', $id);
        $comments->execute();
        return $comments->fetchAll();
    }

    public function postComment(int $id, string $pseudo, string $comment) : void
    {
        $postComment = $this->database->prepare("INSERT INTO commentaires (episode, pseudo, comment, comment_date) 
            VALUES (:episode, :pseudo, :comment, NOW())");
        $postComment->bindParam(':episode', $id);
        $postComment->bindParam(':pseudo', $pseudo);
        $postComment->bindParam(':comment', $comment);

        $postComment->execute();
    }

    public function saveCommentReport(int $commentId) : void
    {
        $reportComment = $this->database->prepare('UPDATE commentaires SET reported_comment = 1 WHERE comment_id = :comment_id');
        $reportComment->bindParam(':comment_id', $commentId);
        $reportComment->execute();
    }

    public function getReportedComments() : array
    {
        $getReportedComments = $this->database->prepare('SELECT * FROM commentaires WHERE reported_comment = 1 ORDER BY episode');
        $getReportedComments->execute();
        return $getReportedComments->fetchAll();
    }

    public function getCommentsList() : array
    {
        $getCommentsList = $this->database->prepare('SELECT * FROM commentaires ORDER BY comment_date DESC LIMIT 10');
        $getCommentsList->execute();
        return $getCommentsList->fetchAll();
    }

    public function delete(int $id) : void
    {
        $deleteComment = $this->database->prepare('DELETE FROM commentaires WHERE comment_id = :id');
        $deleteComment->bindParam(':id', $id);
        $deleteComment->execute();
    }

    public function validate(int $id) : void
    {
        $validate = $this->database->prepare('UPDATE commentaires SET reported_comment = 2 WHERE comment_id = :comment_id');
        $validate->bindParam(':comment_id', $id);
        $validate->execute();
    }
}