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

    public function index($id, $code)
    {
        $query = $this->connection->query("SELECT product.descricao, product.nome, product.preco
        FROM {$this->order->table} AS orders
        INNER JOIN produto AS product ON orders.id_produto = product.id
        WHERE orders.id_usuario = $id AND orders.codigo = $code");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findOne($id)
    {
        $query = $this->connection->query("SELECT orders.codigo, users.nome, address.cep, address.logradouro, address.bairro, address.uf, address.cidade, address.complemento, address.numero
        FROM {$this->order->table} AS orders
        INNER JOIN usuario AS users ON orders.id_usuario = users.id 
        INNER JOIN endereco AS address ON orders.id_endereco = address.id 
        WHERE id_usuario = $id GROUP BY codigo");
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
