<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new CategoryRepository;
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

            return json_encode(['message' => 'Categoria criada com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function update($request, $id)
    {
        try {
            $this->repository->update($request, $id);

            return json_encode(['message' => 'Categoria atualizado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function delete($id)
    {
        try {
            $this->repository->destroy($id);

            return json_encode(['message' => 'Categoria excluido com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
