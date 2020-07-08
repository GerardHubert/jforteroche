<?php
declare(strict_types=1);

namespace App\Model;

use App\Service\Database;

class LogManager
{
    private $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }
}