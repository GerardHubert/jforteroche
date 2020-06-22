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
        $request = $this->database->prepare("SELECT * FROM commentaires WHERE episode = :episode ORDER BY comment_date DESC LIMIT 0, 10");
        $request->bindParam('episode', $id);
        $request->execute();
        
        return $request->fetchAll();
    }
}