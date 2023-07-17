<?php

namespace App\Repositories;

use App\Model\Caracteristic;

class CaracteristicRepository extends GenericRepository
{
    protected $caracteristic;

    public function __construct()
    {
        $this->caracteristic = new Caracteristic();
        parent::__construct($this->caracteristic);
    }


}
