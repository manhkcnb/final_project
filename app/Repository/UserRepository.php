<?php
namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function getAllUsers()
    {
        return User::orderBy('id', 'asc')->get();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser($userData)
    {
        return User::create($userData);
    }

    public function updateUser($id, $userData)
    {
        $user = $this->getUserById($id);
        $user->update($userData);
        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->getUserById($id);
        return $user->delete();
    }
}
