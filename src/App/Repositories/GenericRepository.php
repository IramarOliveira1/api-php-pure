<?php

namespace App\Repositories;

use App\Config\Connection;
use PDO;

class GenericRepository
{
    protected $object;
    protected $connection;

    protected function __construct($object)
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
        $query = $this->connection->query("SELECT * FROM {$this->object->table} WHERE ");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    public function save($request)
    {
        $query = "INSERT INTO {$this->object->table} ({$this->object->fields}) VALUES ('$request')";
        return $this->connection->exec($query);
    }
    public function update()
    {
        var_dump($this->object);
    }
    public function destroy($id)
    {
        $query = "DELETE FROM {$this->object->table} WHERE id = $id ";
        return $this->connection->exec($query);
    }
}
