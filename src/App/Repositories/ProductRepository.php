<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\Product;

class ProductRepository extends GenericRepository
{
    private $product;

    private $connection;

    public function __construct()
    {
        $this->product = new Product();
        parent::__construct($this->product);
        $this->connection = Connection::getInstance();
    }

    public function save($request)
    {
        $query = "INSERT INTO {$this->product->table} ({$this->product->fields}) VALUES ('$request')";
        $this->connection->exec($query);
        return $this->connection->lastInsertId();
    }
}
