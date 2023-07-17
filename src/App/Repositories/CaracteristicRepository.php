<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\Caracteristic;

class CaracteristicRepository extends GenericRepository
{
    protected $caracteristic;

    protected $connection;

    public function __construct()
    {
        $this->caracteristic = new Caracteristic();
        parent::__construct($this->caracteristic);
        $this->connection = Connection::getInstance();
    }

    public function save($request)
    {
        $query = "INSERT INTO {$this->caracteristic->table} ({$this->caracteristic->fields}) VALUES ('$request')";
        $this->connection->exec($query);

        return $this->connection->lastInsertId();
    }
}
