<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function registerUser(array $userData);
    public function findUserByEmail(string $email): ?User;
    public function getUserById(int $id): ?User;
    public function updateUser(int $id, array $newDetails): bool;
    public function deleteUser(int $id): bool;
}
