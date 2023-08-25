<?php 
namespace App\Service\Frontend;;

use Hash;
use App\Repository\Frontend\CustomerRepository;
use Illuminate\Support\Facades\Session;

class CustomerService
{
    private $customerRepo;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    public function login($email, $password)
    {
        return $this->customerRepo->getUserByEmail($email, $password);
    }

    public function syncCartWithDatabase($cart, $customerEmail)
    {
        $this->customerRepo->syncCart($cart, $customerEmail);
    }

    public function checkEmailExists($email)
    {
        return $this->customerRepo->checkEmailExists($email);
    }

    public function createCustomer($data)
    {
        $this->customerRepo->createCustomer($data);
    }
    public function getCartByEmail($email)

    {
            $cart = session()->get('cart');
            if (!empty($cart)) {
                $this->customerRepo->syncCart($cart, $email);
            }
             session()->forget('cart');
             $cartFromDatabases = $this->customerRepo->getCartByEmail($email);
             if($cartFromDatabases){
                foreach($cartFromDatabases as $cartFromDatabase){
                     $cartItem = [
                        "name" => $cartFromDatabase->name,
                        "photo" => $cartFromDatabase->photo,
                        "price" => $cartFromDatabase->price,
                        "quantity" => $cartFromDatabase->quantity,
                        "size" => $cartFromDatabase->size,
                        "color" => $cartFromDatabase->color,
                    ];
                    $key=$cartItem['name'].$cartItem['color'].$cartItem['size'];
                    $cart[$key] = $cartItem;
                    Session::put('cart', $cart);
                }
            }
             

        
    }

}

 ?>