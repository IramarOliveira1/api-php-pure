<?php

namespace App\Repositories;

use App\Config\Connection;
use PDO;

class GenericRepository
{
    private $object;
    private $connection;

    public function __construct($object)
    {
        $this->object = $object;
        $this->connection = Connection::getInstance();
    }

    public function findAll()
    {
        $query = $this->connection->query("SELECT * FROM {$this->object->table}");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT * FROM {$this->object->table} WHERE id = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($request)
    {
        $query = "INSERT INTO {$this->object->table} ({$this->object->fields}) VALUES ('$request')";
        return $this->connection->exec($query);
    }

    public function update($request, $id)
    {
        $query = "UPDATE {$this->object->table} SET $request WHERE id = $id";
        return $this->connection->exec($query);
    }

    public function destroy($id)
    {
        $query = "DELETE FROM {$this->object->table} WHERE id = $id ";
        return $this->connection->exec($query);
    }
}
