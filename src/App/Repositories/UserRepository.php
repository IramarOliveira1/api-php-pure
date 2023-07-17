<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\User;

class UserRepository extends GenericRepository
{
    private $user;

    private $connection;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct($this->user);
        $this->connection = Connection::getInstance();
    }

    public function save($request)
    {
        $query = "INSERT INTO {$this->user->table} ({$this->user->fields}) VALUES ('$request')";
        $this->connection->exec($query);
        return $this->connection->lastInsertId();
    }
}
