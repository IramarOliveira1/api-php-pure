<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Exception;

class ProductService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ProductRepository;
    }

    public function all()
    {
        return $this->repository->findAll();
    }

    public function index($id)
    {
        return $this->repository->findOne($id);
    }
    
    public function store($request)
    {
        try {
            $this->repository->save($request);

            return json_encode(['message' => 'Produto criado com sucesso', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function update($request, $id)
    {
        try {
            $this->repository->update($request, $id);

            return json_encode(['message' => 'Produto atualizado com sucesso', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->destroy($id);

            return json_encode(['message' => 'Produto excluido com sucesso', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
