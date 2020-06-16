<?php
declare(strict_types = 1);

namespace App\Model;

use App\Service\Database;

class CommentManager {

    public function __construct(Database $database) {
        $this->database = $database->databaseConnect();
    }

    public function getComments(int $id) {
        $comments = [];
        $this->request = $this->database->query("SELECT * FROM commentaires WHERE episode = $id ORDER BY comment_date DESC");

        while ($this->data = $this->request->fetch()) {
            $comment = $this->data['comment'];
            $pseudo = $this->data['pseudo'];
            $date = $this->data['comment_date'];
            array_push($comments, ['comment' => $comment, 'pseudo' => $pseudo, 'date' => $date]);
        }
        return $comments;
    }
}