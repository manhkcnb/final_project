<?php 
namespace App\Repository;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Mail\RecoveryCodeEmail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AdminRepository
{
    public function authenticate($email, $password)
    {
        $admin = Admin::where("email", $email)->first();

        if ($admin && Hash::check($password, $admin->password)) {
            return true;
        }

        return false;
    }

    public function sendRecoveryCode($email)
	{
	    $admin = Admin::where("email", $email)->first();

	    if ($admin) {
	        $recoveryCode = Str::random(6);
	        $admin->update(["recovery_code" => $recoveryCode]);
	        $subject = 'Password recovery';
        	$message = 'Your account recovery code is:
        	' . $recoveryCode ;
        	$mail = new PHPMailer(true);
		try {
            $mail->isSMTP();
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'manhkcnb35@gmail.com';
            $mail->Password = 'razxkupiircnyugz';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('manhkcnb35@gmail.com', 'Admin');
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->msgHTML($message);
            $mail->send();
	            
	            return true;
	        } catch (Exception $e) {
	            
	            return false;
	        }
	    }
	}

    public function isValidRecoveryCode($email, $code)
    {
        $admin = Admin::where("email", $email)->where("recovery_code", $code)->first();
        return $admin !== null;
    }

    public function updatePassword($email, $password)
    {
        $admin = Admin::where("email", $email)->first();
        if ($admin) {
            $admin->update(["password" => Hash::make($password)]);
            return true;
        }
        return false;
    }
}
