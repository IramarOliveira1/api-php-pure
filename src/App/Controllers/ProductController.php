<?php

namespace App\Controllers;

use App\Services\ProductService;

class ProductController
{
    private $service;

    public function __construct()
    {
        $this->service = new ProductService;
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
        return $this->service->store($_POST);
    }

    public function update(int $id)
    {
        return $this->service->update($_POST, $id);
    }

    public function delete(int $id)
    {
        return $this->service->delete($id);
    }
}
