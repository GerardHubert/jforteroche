<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class UserManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getUser(string $user) : array
    {
        $request = $this->database->prepare('SELECT *
            FROM users
            WHERE username = :user');
        $request->bindParam(':user', $user);
        $request->execute();
        return $request->fetchAll();
    }

    public function updateUsername($newUsername) : void
    {
        //requete pour enregistrer le nouveau nom d'utilisateur
        $request = $this->database->prepare('UPDATE users
            SET username = :new_username');
        $request->bindParam(':new_username', $newUsername);
        $request->execute();
    }

    public function updatePassword(string $newHash) : void
    {
        $request = $this->database->prepare('UPDATE users
            SET pass = :new_pass');
        $request->bindParam(':new_pass', $newHash);
        $request->execute();
    }
}