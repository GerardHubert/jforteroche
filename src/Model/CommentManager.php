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

        $request = $this->database->prepare("SELECT * FROM commentaires WHERE episode = ? ORDER BY comment_date DESC");
        $request->bindParam(1, $id);
        $request->execute();
        
        $comments = $request->fetchAll();
        
        return $comments;
    }
}