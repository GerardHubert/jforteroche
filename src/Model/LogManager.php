<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class LogManager
{
    private $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function saveNewUser($id, $pass) : void
    {
        $saveNewUser = $this->database->prepare('INSERT INTO authentification (id, pass) VALUES (:identifiant, :pass)');
        $saveNewUser->bindParam(':identifiant', $id);
        $saveNewUser->bindParam(':pass', $pass);
        $saveNewUser->execute();
    }
}