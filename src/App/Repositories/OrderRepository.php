<?php

namespace App\Repositories;

use App\Config\Connection;
use App\Model\Order;
use PDO;

class OrderRepository extends GenericRepository
{
    private $order;

    private $connection;

    public function __construct()
    {
        $this->order = new Order();
        parent::__construct($this->order);
        $this->connection = Connection::getInstance();
    }


    public function index($id)
    {
        $query = $this->connection->query("SELECT orders.codigo, product.descricao, product.nome AS nome_produto, product.preco, users.nome AS nome_usuario, users.cpf, address.logradouro 
        FROM {$this->order->table} AS orders
        INNER JOIN produto AS product ON orders.id_produto = product.id
        INNER JOIN usuario AS users ON orders.id_usuario = users.id
        INNER JOIN endereco AS address ON users.id_endereco = address.id
        WHERE orders.id_usuario = $id");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($code)
    {
        $query = $this->connection->query("SELECT * FROM {$this->order->table} WHERE codigo = $code");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
