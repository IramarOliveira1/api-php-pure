<?php

namespace App\Services;

use Exception;
use App\Repositories\OrderRepository;

class OrderService extends GenericService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new OrderRepository;
    }

    public function all($id)
    {
        return $this->repository->index($id);
    }

    public function setOrder($request, $id_user)
    {
        try {
            $code = date("Y") . time();

            foreach ($request->produto as $value) {
                $object = [
                    'codigo' => $code,
                    'id_produto' => $value->id_produto,
                    'id_usuario' => $id_user
                ];

                $order = $this->request($object);

                $this->repository->save($order);
            }

            return json_encode(['message' => 'Pedido criado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
