<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{

    public function create(array $data): User;

    public function findByEmail(string $email): ?User;

    public function getAllUsers();

    public function getUserById($userId);

    public function createUser(array $userDetails);

    public function updateUser($userId, array $newDetails);

    public function deleteUser($userId);
}
