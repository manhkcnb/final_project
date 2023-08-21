<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function login()
    {
        return view('admin.login.form_login');
    }

    public function loginPost(Request $request)
    {
        $email = $request->input("email");
        $password = $request->input("password");

        if ($this->adminService->authenticate($email, $password)) {
            return view('admin.home.read');
        } else {
            return redirect(url('backend/login?notify=invalid'));
        }
    }

    public function forgotPassword()
    {
        return view("admin.login.forgotpassword");
    }

    public function forgotPasswordPost(Request $request)
    {
        $email = $request->input("email");

        
        if ($this->adminService->sendRecoveryCode($email)) {
            return view("admin.login.resetpass", ['email' => $email]);
        } else {
            return "No email address";
        }
    }

    public function resetPassword(Request $request)
    {
        $code = $request->input("code");
        $email = $request->input("email");
        
        if ($this->adminService->isValidRecoveryCode($email, $code)) {
            return view("admin.login.password_new", ["email" => $email]);
        } else {
            return "Wrong code";
        }
    }

    public function passwordNew(Request $request)
    {
        $password = $request->input("password");
        $email = $request->input("email");
        
        if ($this->adminService->updatePassword($email, $password)) {
            return view("admin.login.form_login");
        } else {
            return "Failed to update password";
        }
    }
}
