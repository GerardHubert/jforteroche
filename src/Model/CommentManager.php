<?php
declare(strict_types = 1);

namespace App\Model;

use App\Service\Database;

class CommentManager
{

    public function __construct(Database $database)
    {
        $this->database = $database->databaseConnect();
    }

    public function getComments(int $id)
    {
        $comments = [];

        $request = $this->database->prepare("SELECT * FROM commentaires WHERE episode = ? ORDER BY comment_date DESC");
        $request->bindParam(1, $id);
        $request->execute();
            

        while ($data = $request->fetch()) {
            $comment = $data['comment'];
            $pseudo = $data['pseudo'];
            $date = $data['comment_date'];
            array_push($comments, ['comment' => $comment, 'pseudo' => $pseudo, 'date' => $date]);
        }
        
        return $comments;
    }
}