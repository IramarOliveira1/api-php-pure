<?php

namespace App\Services;

use App\Interface\GenericInterface;
use App\Repositories\CaracteristicRepository;
use App\Repositories\ProductRepository;
use Exception;

class ProductService extends GenericService implements GenericInterface
{
    private $repository;

    private $caracteristic;

    public function __construct()
    {
        $this->repository = new ProductRepository;
        $this->caracteristic = new CaracteristicRepository;
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

            $product = $this->createOrUpdate($request);
            $this->repository->save($product);

            return json_encode(['message' => 'Produto criado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function update($request, $id)
    {
        try {
            $product = $this->createOrUpdate($request);

            $this->repository->update($product, $id);

            return json_encode(['message' => 'Produto atualizado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function delete($id)
    {
        try {

            $id_caracteristic = $this->repository->findOne($id);

            $this->repository->destroy($id);

            $this->caracteristic->destroy($id_caracteristic[0]['id_caracteristica']);

            return json_encode(['message' => 'Produto excluido com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function createOrUpdate($request)
    {
        try {
            if ($request->request->product->id_caracteristica) {
                $caracteristic = $this->mountedUpdate($request->request->caracteristic);
                $this->caracteristic->update($caracteristic, $request->request->product->id_caracteristica);

                $product = $this->mountedUpdate($request->request->product);


                return $product;
            }

            $caracteristic = $this->request($request->request->caracteristic);

            $id_caracteristic = $this->caracteristic->save($caracteristic);

            $request->request->product->id_caracteristica = $id_caracteristic;

            $product = $this->request($request->request->product);

            return $product;
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
