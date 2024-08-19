<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService {

    private $UserRepositoryInterface;

    public function __construct(UserRepositoryInterface $UserRepositoryInterface)
    {
        $this->UserRepositoryInterface = $UserRepositoryInterface;
    }

    // Add your service methods here
}