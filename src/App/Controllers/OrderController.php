<?php

namespace App\Controllers;

use App\Services\GenericService;
use App\Services\OrderService;

class OrderController
{
    private $service;
    private $request;

    public function __construct()
    {
        $this->service = new OrderService;
        if (!empty(file_get_contents('php://input'))) {
            $this->request = new GenericService(file_get_contents('php://input'));
        }
    }


    public function all(int $id)
    {
        return $this->service->all($id);
    }

    public function setOrder(int $id_user)
    {
        return $this->service->setOrder($this->request->request, $id_user);
    }
}
