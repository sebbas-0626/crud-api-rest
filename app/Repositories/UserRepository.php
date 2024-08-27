<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAllUsers()
    {
        return $this->user->all();
    }

    public function getUserById($userId)
    {
        return $this->user->findOrFail($userId);
    }

    public function createUser(array $userDetails)
    {
        $userDetails['password'] = bcrypt($userDetails['password']);
        return $this->user->create($userDetails);
    }

    public function updateUser($userId, array $newDetails)
    {
        if (isset($newDetails['password'])) {
            $newDetails['password'] = bcrypt($newDetails['password']);
        }

        return $this->user->whereId($userId)->update($newDetails);
    }

    public function deleteUser($userId)
    {
        return $this->user->destroy($userId);
    }
}
