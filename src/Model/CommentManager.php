<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class CommentManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getComments(int $numero) : array
    {
        $comments = $this->database->prepare("SELECT *, DATE_FORMAT(comment_date, '%d/%m/%Y - %H:%i:%s') AS comment_date
            FROM commentaires WHERE episode = :episode
            ORDER BY comment_date
            LIMIT 0, 10");
        $comments->bindParam(':episode', $numero);
        $comments->execute();
        return $comments->fetchAll();
    }

    public function postComment(int $episodeId, string $pseudo, string $comment) : void
    {
       $postComment = $this->database->prepare("INSERT INTO commentaires (episode, pseudo, comment, comment_date)
            VALUES (:episode, :pseudo, :comment, NOW())");
        $postComment->bindParam(':episode', $episodeId);
        $postComment->bindParam(':pseudo', $pseudo);
        $postComment->bindParam(':comment', $comment);
        $postComment->execute();    
    }

    public function saveCommentReport(int $commentId) : void
    {
        $reportComment = $this->database->prepare('UPDATE commentaires 
            SET reported_comment = 1 
            WHERE comment_id = :comment_id');
        $reportComment->bindParam(':comment_id', $commentId);
        $reportComment->execute();
    }

    public function getReportedComments() : array
    {
        $getReportedComments = $this->database->prepare("SELECT * FROM commentaires
            INNER JOIN episodes
            ON episodes.episode_id = commentaires.episode
            WHERE reported_comment = 1 ");
        $getReportedComments->execute();
        return $getReportedComments->fetchAll();
    }

    public function getCommentsList($offset) : array
    {
        $getCommentsList = $this->database->prepare("SELECT * FROM commentaires
            INNER JOIN episodes
            ON episodes.episode_id = commentaires.episode
            ORDER BY commentaires.episode DESC
            LIMIT 10 OFFSET :beginning");
        $getCommentsList->bindParam(':beginning', $offset, \PDO::PARAM_INT);
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
        $validate = $this->database->prepare('UPDATE commentaires 
            SET reported_comment = 2 
            WHERE comment_id = :comment_id');
        $validate->bindParam(':comment_id', $id);
        $validate->execute();
    }

    public function getCommentsNumber() : int
    {
        $request = $this->database->prepare('SELECT comment_id
            FROM commentaires');
        $request->execute();
        return count($request->fetchAll());
    }
}