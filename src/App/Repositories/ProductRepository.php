<?php

namespace App\Repositories;

use App\Model\Product;

class ProductRepository extends GenericRepository
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
        parent::__construct($this->product);
    }
}
