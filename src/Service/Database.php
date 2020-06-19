<?php
declare(strict_types=1);
namespace App\Service;

use PDOException;

class Database
{
    private $servor = 'mysql:dbname=jean_forteroche;host=localhost;port=3308;chartset=utf-8';
    private $user = 'root';
    private $password = '';

    public function databaseConnect()
    {
        $connect = new \PDO($this->servor, $this->user, $this->password);
        return $connect;
    }
}

