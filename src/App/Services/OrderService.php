<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use App\Repositories\OrderRepository;

class OrderService extends GenericService
{
    private $repository;

    private $user;

    public function __construct()
    {
        $this->repository = new OrderRepository;
        $this->user = new UserRepository;
    }

    public function all($id)
    {
        $result = $this->repository->findOne($id);

        return $this->mountedOrder($id, $result);
    }

    public function mountedOrder($id, $data)
    {
        $orders = [];

        foreach ($data as $value) {
            $index = $this->repository->index($id, $value['codigo']);

            array_push(
                $orders,
                [
                    "orders" => [
                        "products" => $index,
                        "code" => $value['codigo'],
                        "user" => $value["nome"],
                        "address" => [
                            "cep" =>  $value['cep'],
                            "logradouro" =>  $value['logradouro'],
                            "bairro" =>  $value['bairro'],
                            "uf" =>  $value['uf'],
                            "cidade" =>  $value['cidade'],
                            "complemento" =>  $value['complemento'],
                            "numero" => (int) $value['numero'],
                        ]
                    ]
                ]
            );
        }
        return $orders;
    }

    public function setOrder($request, $id_user)
    {
        try {
            $code = date("Y") . time();

            $id_address = $this->user->findOne($id_user);

            foreach ($request->produto as $value) {
                $object = [
                    'codigo' => $code,
                    'id_produto' => $value->id_produto,
                    'id_usuario' => $id_user,
                    'id_endereco' => $id_address[0]['id_endereco']
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
