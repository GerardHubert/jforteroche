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

    public function checkUser(string $user) : bool
    {
        $test = $this->database->prepare('SELECT user 
            FROM authentification
            WHERE user = :user_to_check');
        $test->bindParam(':user_to_check', $user);
        $test->execute();
        $result = $test->fetchColumn();

        if (isset($result) && $result === $user) {
            return true;
        }
        return false;
    }

    public function saveNewUser(string $id, string $pass) : void
    {
        $saveNewUser = $this->database->prepare('INSERT INTO authentification (user, pass) VALUES (:identifiant, :pass)');
        $saveNewUser->bindParam(':identifiant', $id);
        $saveNewUser->bindParam(':pass', $pass);
        $saveNewUser->execute();
    }

    public function getHashedPass(string $user) : string
    {
        $getPass = $this->database->prepare('SELECT pass
            FROM authentification
            WHERE user = :user');
        $getPass->bindParam(':user', $user);
        $getPass->execute();
        return $getPass->fetchColumn(0);
    }
}