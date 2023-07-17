<?php

namespace App\Services;

use App\Repositories\AddressRepository;
use App\Repositories\UserRepository;
use Exception;

class UserService extends GenericService
{
    private $repository;
    private $address;

    public function __construct()
    {
        $this->repository = new UserRepository;
        $this->address = new AddressRepository;
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

            return json_encode(['message' => 'Usuário criado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function update($request, $id)
    {
        try {
            $this->createOrUpdateAddress($request);

            $user = $this->mountedUpdate($request->request->user);

            $this->repository->update($user, $id);

            return json_encode(['message' => 'Usuário atualizado com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function delete($id)
    {
        try {

            $id_address = $this->repository->findOne($id);

            $this->repository->destroy($id);

            $this->address->destroy($id_address[0]['id_endereco']);

            return json_encode(['message' => 'Usuário excluido com sucesso!', 'error' => false]);
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }

    public function createOrUpdateAddress($request)
    {
        try {

            if ($request->request->user->id_endereco) {
                $address = $this->mountedUpdate($request->request->address);
                $this->address->update($address, $request->request->user->id_endereco);
                return;
            }

            $address = $this->request($request->request->address);

            $id_address = $this->address->save($address);

            $request->request->user->id_endereco = $id_address;
        } catch (Exception $e) {
            return json_encode(['message' => $e->getMessage(), 'error' => true]);
        }
    }
}
