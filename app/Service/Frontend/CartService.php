<?php

namespace App\Service\Frontend;

use App\Repository\Frontend\CartRepository;
use Illuminate\Support\Facades\Session;

class CartService
{
    private $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function list(){
        $cart = Session::get('cart');
        return $cart;
    }

    public function addToCart( $arr)

    {
        //
        $cart = Session::get('cart');
        $key=$arr['name'].$arr['color'].$arr['size'];

        if(isset($cart[$key])){
            $cart[$key]['quantity']+=$arr['quantity'];
        }else {
           
            $cart[$key] = $arr; 
        } 
        Session::put('cart', $cart);
        if(session()->has("customer_email")){
            $email=session()->get("customer_email");
            $this->cartRepository->addToCart($email,$arr);
        }

       
    }

    public function updateCartItemQuantity( $cartItemId, $newQuantity)
    {   
         $cart = Session::get('cart');
        if($newQuantity==0){
            unset($cart[$cartItemId]);
        }
        else {
             $cart[$cartItemId]['quantity'] = $newQuantity;
        }
         Session::put('cart', $cart);
        if(session()->has("customer_email")){
            $email=session()->get("customer_email");
            $this->cartRepository->updateCartItemQuantity($email, $cartItemId, $newQuantity,$cart);
        }
    }

    public function deleteCartItem($cartItemId)
    {
        $cart = Session::get('cart');
        if(session()->has('customer_email')){
            $email=session()->get('customer_email');
            $this->cartRepository->deleteCartItem($email, $cartItemId,$cart);
        }

       
        unset($cart[$cartItemId]);
        Session::put('cart', $cart);

    }

    public function clearCart()

    {
        Session::forget('cart');
        if(session()->has('customer_email')){
            $email=session()->get('customer_email');
            $this->cartRepository->clearCart($email);
        }
    }
    public function getCartByEmail($email)
    {
        return $this->cartRepository->getCartByEmail($email);
    }
    // Add more methods as needed...
}
