<?php 
namespace App\Repository\Frontend;

use DB;
use App\Models\User;
use App\Models\Cart;

class CustomerRepository
{
    public function getUserByEmail($email)
    {
        return User::where("email", $email)->first();
    }

    public function syncCart($cart, $customerEmail)
    {
        foreach ($cart as $row) {
            $datas = Cart::where("customer_email", "=", $customerEmail)
                ->where('name', "=", $row["name"])
                ->where('color', "=", $row["color"])
                ->where('size', "=", $row["size"])
                ->first();

            if ($datas) {
                Cart::where("customer_email", "=", $customerEmail)
                    ->where('name', "=", $row["name"])
                    ->where('color', "=", $row["color"])
                    ->where('size', "=", $row["size"])
                    ->increment('quantity', $row['quantity']);
            } else {
                Cart::insert([
                    "customer_email" => $customerEmail,
                    "name" => $row["name"],
                    "color" => $row["color"],
                    "size" => $row["size"],
                    "price" => $row["price"],
                    "quantity" => $row["quantity"],
                    "photo" => $row["photo"]
                ]);
            }
        }
    }

    public function checkEmailExists($email)
    {
        return User::where("email", "=", $email)->exists();
    }

    public function createCustomer($data)
    {
        User::create([
            "email" => $data["email"],
            "name" => $data["name"],
            "password" => $data["password"],
            "role" => $data["role"]
        ]);
    }
    public function getCartByEmail($customerEmail)
    {
        return Cart::where('customer_email', $customerEmail)
            ->get();
    }
}

