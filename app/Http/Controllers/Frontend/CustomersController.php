<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Frontend\CustomerService;

class CustomersController extends Controller
{
    private $customerService;
    public function login()
        {
            return view("frontend.login");
        }
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    

    public function loginPost()
    {
        $email = request()->get("email");
        $password = request()->get("password");

        $user = $this->customerService->login($email, $password);

        if ($user) {
            session()->put("customer_email", $user->email);
            $this->customerService->getCartByEmail($email);
            
            return redirect(url(''));
        }

        return redirect(url('login?notify=invalid'));
    }

    public function register()
    {
        return view("frontend.register");
    }

    public function registerPost()
    {
        $data = [
            "email" => request()->get("email"),
            "password" => Hash::make(request()->get("password")),
            "name" => request()->get("name"),
            "role" => "3"
        ];

        if (!$this->customerService->checkEmailExists($data["email"])) {
            $this->customerService->createCustomer($data);
        } else {
            return redirect(url('customers/register?notify=invalid'));
        }

        return redirect(url('login'));
    }

    public function logout()
    {
        session()->remove("cart");
        session()->remove("customer_email");
        session()->remove("customer_id");
        return redirect(url(''));
    }
}

