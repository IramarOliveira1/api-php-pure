<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\PivotProductCategory;
use PDO;

class PivotProductCategoryRepository extends GenericRepository
{
    private $pivot;

    private $connection;

    public function __construct()
    {
        $this->pivot = new PivotProductCategory();
        parent::__construct($this->pivot);
        $this->connection = Connection::getInstance();
    }

    public function verifyPivotExists($id_product)
    {
        $query = $this->connection->query("SELECT * FROM {$this->pivot->table} WHERE id_produto = $id_product ");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
