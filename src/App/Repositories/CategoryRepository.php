<?php

namespace App\Repositories;

use App\Model\Category;

class CategoryRepository extends GenericRepository
{
    protected $category;

    public function __construct()
    {
        $this->category = new Category();
        parent::__construct($this->category);
    }
}
