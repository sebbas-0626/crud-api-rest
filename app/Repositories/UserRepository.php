<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements Interfaces\UserRepositoryInterface {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function registerUser(array $userData)
    {
        $userData['password'] = Hash::make($userData['password']);
        return $this->user->create($userData);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->user->where('email', $email)->first();
    }

    public function getUserById(int $id): ?User
    {
        return $this->user->find($id);
    }

    public function updateUser(int $id, array $newDetails): bool
    {
        $user = $this->user->find($id);

        if ($user) {
            return $user->update($newDetails);
        }

        return false;
    }

    public function deleteUser(int $id): bool
    {
        $user = $this->user->find($id);

        if ($user) {
            return $user->delete();
        }

        return false;
    }
}
