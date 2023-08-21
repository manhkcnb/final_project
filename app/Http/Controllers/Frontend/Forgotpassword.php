<?php

namespace App\Http\Controllers\frontend;
use App\Service\AdminService;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Forgotpassword extends Controller
{
    // public function read(){
    //     return view("frontend.Forgotpassword");
    // }
    // public function forgotpasswordPost( Request $request){
    //     $email = request("email");
    //     $data = DB::table("users")->where("email", "=", $email)->first();

    //     if (isset($data)) {
    //         $recoveryCode = Str::random(6);
    //         DB::table("users")->where("email", "=", $email)->update(["recovery_code" => $recoveryCode]);
    //         $this->sendRecoveryEmail($email, $recoveryCode);
    //         return view("frontend.resetpass",['email'=>$email]);
    //     } else {
    //         echo "No email address";
    //     }
    // }
    // public function sendRecoveryEmail($to, $recoveryCode) {
    //     $subject = 'Password recovery';
    //     $message = 'Your account recovery code is:
    //     ' . $recoveryCode ;
        
    //     $mail = new PHPMailer(true);

    //     try {
    //         $mail->isSMTP();
    //         $mail->IsHTML(true);
    //         $mail->CharSet = 'UTF-8';
    //         $mail->Host = 'smtp.gmail.com';
    //         $mail->SMTPAuth = true;
    //         $mail->Username = 'manhkcnb35@gmail.com';
    //         $mail->Password = 'razxkupiircnyugz';
    //         $mail->SMTPSecure = 'tls';
    //         $mail->Port = 587;

    //         $mail->setFrom('manhkcnb35@gmail.com', 'Mạnh Nè');
    //         $mail->addAddress($to);
    //         $mail->Subject = $subject;
    //         $mail->msgHTML($message);
    //         $mail->send();

    //     } catch (Exception $e) {
    //         echo 'Error: ' . $mail->ErrorInfo;
    //     }
    // }public function reset( Request $request){
    //         $code=request("code");
    //         $email=request("email");
    //         $data=DB::table('users')->where("email","=",$email)->where("recovery_code","=",$code)->first();
    //         if(isset($data)){
    //             return view("frontend.password_new",["email"=>$email]);
    //         }else{
    //             return view("frontend.Forgotpassword");
    //         }
    // }
    // public function passwordNew(Request $request){
    //     $password=request("password");
    //     $email=Hash::make(request("email"));
    //     DB::table('users')->where("email","=",$email)->update(["password"=>$password]); 
    //     return view("frontend.login");

    // }
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }
    public function forgotPassword()
    {
        return view("frontend.Forgotpassword");
    }

    public function forgotPasswordPost(Request $request)
    {
        $email = $request->input("email");

        
        if ($this->adminService->sendRecoveryCode($email)) {
            return view("frontend.resetpass", ['email' => $email]);
        } else {
            return "No email address";
        }
    }

    public function resetPassword(Request $request)
    {
        $code = $request->input("code");
        $email = $request->input("email");
        
        if ($this->adminService->isValidRecoveryCode($email, $code)) {
            return view("frontend.password_new", ["email" => $email]);
        } else {
            return "Wrong code";
        }
    }

    public function passwordNew(Request $request)
    {
        $password = $request->input("password");
        $email = $request->input("email");
        
        if ($this->adminService->updatePassword($email, $password)) {
            return view("frontend.login");
        } else {
            return "Failed to update password";
        }
    }
}
