<?php 
namespace App\Service;

use Illuminate\Support\Facades\Hash;
use App\Repository\AdminRepository;

class AdminService
{
    protected $adminRepository;

    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function authenticate($email, $password)
    {
        return $this->adminRepository->authenticate($email, $password);
    }

    public function sendRecoveryCode($email)
    {
        return $this->adminRepository->sendRecoveryCode($email);
    }

    public function isValidRecoveryCode($email, $code)
    {
        return $this->adminRepository->isValidRecoveryCode($email, $code);
    }

    public function updatePassword($email, $password)
    {
        return $this->adminRepository->updatePassword($email, $password);
    }
}
