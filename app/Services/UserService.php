<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface as InterfacesUserRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    private $userRepository;

    public function __construct(InterfacesUserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // Aquí puedes añadir los métodos del servicio que usarán el repositorio

    public function registerUser(array $userData)
    {
        return $this->userRepository->registerUser($userData);
    }

    public function findUserByEmail(string $email)
    {
        return $this->userRepository->findUserByEmail($email);
    }

    // Otros métodos que necesites
}
