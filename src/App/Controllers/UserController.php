<?php

namespace App\Controllers;

use App\Services\GenericService;
use App\Services\UserService;

class UserController
{
    private $service;
    private $request;

    public function __construct()
    {
        $this->service = new UserService;
        if (!empty(file_get_contents('php://input'))) {
            $this->request = new GenericService(file_get_contents('php://input'));
        }
    }

    public function all()
    {
        return $this->service->all();
    }

    public function index(int $id)
    {
        return $this->service->index($id);
    }

    public function store()
    {
        $values = $this->request->request();
        return $this->service->store($values);
    }

    public function update(int $id)
    {
        $values = $this->request->mountedUpdate();
        return $this->service->update($values, $id);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }
}
