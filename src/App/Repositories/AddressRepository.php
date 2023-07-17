<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\Address;

class AddressRepository extends GenericRepository
{
    protected $address;

    private $connection;

    public function __construct()
    {
        $this->address = new Address();
        parent::__construct($this->address);
        $this->connection = Connection::getInstance();
    }

     public function save($request)
    {
        $query = "INSERT INTO {$this->address->table} ({$this->address->fields}) VALUES ('$request')";
        $this->connection->exec($query);

        return $this->connection->lastInsertId();
    }
}
