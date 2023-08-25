<?php

namespace App\Repository\Frontend;

use DB;
use App\Models\Cart;

class CartRepository
{
    public function addToCart($email, $cartItem)
    {
        $key = $cartItem['name'] . $cartItem['color'] . $cartItem['size'];

        $existingCartItem = Cart::where('customer_email', $email)
            ->where('name', $cartItem['name'])
            ->where('color', $cartItem['color'])
            ->where('size', $cartItem['size'])
            ->first();

        if ($existingCartItem) {
            Cart::where('id', $existingCartItem->id)
                ->increment('quantity', $cartItem['quantity']);
        } else {
            Cart::insert([
                "customer_email" => $email,
                "name" => $cartItem['name'],
                "color" => $cartItem['color'],
                "size" => $cartItem['size'],
                "price" => $cartItem['price'],
                "quantity" => $cartItem['quantity'],
                "photo" => $cartItem['photo']
            ]);
        }
    }

    public function updateCartItemQuantity($email, $id, $newQuantity, $cart)
    {
        if ($newQuantity === 0) {
             Cart::where("customer_email","=",$email)->where("name","=",$cart[$id]['name'])->where("color","=",$cart[$id]['color'])->where("size","=",$cart[$id]['size'])->delete();
        } else {
            Cart::where("customer_email","=",$email)->where("name","=",$cart[$id]['name'])->where("color","=",$cart[$id]['color'])->where("size","=",$cart[$id]['size'])->update(['quantity' => $newQuantity]);
        }
    }

    public function deleteCartItem($email, $id,$cart)
    {
         Cart::where("customer_email","=",$email)->where("name","=",$cart[$id]['name'])->where("color","=",$cart[$id]['color'])->where("size","=",$cart[$id]['size'])->delete();
    }

    public function clearCart($email)
    {
        Cart::where('customer_email', $email)
            ->delete();
    }
     public function getCartByEmail($email)
    {
        return Cart::where('customer_email', $email)
            ->get();
    }

    // Add more methods as needed...
}
