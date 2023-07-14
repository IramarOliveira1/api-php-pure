<?php

namespace App\Repositories;

use App\Model\User;

class UserRepository extends GenericRepository
{
    protected $user;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct($this->user);
    }
}
