<?php
namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAllUsers();
    }

    public function getUserById($id)
    {
        return $this->userRepository->getUserById($id);
    }

    public function createUser($userData)
    {
        return $this->userRepository->createUser($userData);
    }

    public function updateUser($id, $userData)
    {
        return $this->userRepository->updateUser($id, $userData);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->deleteUser($id);
    }
}
