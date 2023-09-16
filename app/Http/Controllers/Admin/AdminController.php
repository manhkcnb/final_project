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
        $requestData = json_decode(file_get_contents("php://input"));
        $email=$requestData->email;
        $password=$requestData->password;
         

        if ($this->adminService->authenticate($email, $password)) {
            // return view('admin.home.read');
            return response()->json("done");
        } else {
            return response()->json("not");
        }
    }

    public function forgotPassword()
    {
        return view("admin.login.forgotpassword");
    }

    public function forgotPasswordPost(Request $request)
    {
        $requestData = json_decode(file_get_contents("php://input"));
        $email=$requestData->email;

        
        if ($this->adminService->sendRecoveryCode($email)) {
            return response()->json("done");
            // return view("admin.login.resetpass", ['email' => $email]);
        } else {
            return "No email address";
        }
    }

    public function resetPassword(Request $request)
    {   $requestData = json_decode(file_get_contents("php://input"));
        $code = $requestData->code;
        $email = $requestData->email;
        
        if ($this->adminService->isValidRecoveryCode($email, $code)) {
            return response()->json("done");
        } else {
            return "Wrong code";
        }
    }

    public function passwordNew(Request $request)
    {
        $requestData = json_decode(file_get_contents("php://input"));
        $password = $requestData->password;
        $email = $requestData->email;
        
        if ($this->adminService->updatePassword($email, $password)) {
            return response()->json("done");
        } else {
            return "Failed to update password";
        }
    }
}
