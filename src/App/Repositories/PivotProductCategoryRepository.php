<?php

namespace App\Repositories;

use App\Model\PivotProductCategory;

class PivotProductCategoryRepository extends GenericRepository
{
    protected $pivot;

    public function __construct()
    {
        $this->pivot = new PivotProductCategory();
        parent::__construct($this->pivot);
    }
}
