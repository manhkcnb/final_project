<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Http\ShoppingCart\Cart;
use App\Http\Controllers\Frontend\Session;


class CartController extends Controller
{  
    public function buy(Request $request){
        $name=request("name");
        $photo=request("photo");
        $price=request("price");
        $quantity=request("quantity");
        $size=request("size");
        $color=request("color");
        $arr=array("name"=>$name,"photo"=>$photo,"price"=>$price,"quantity"=>$quantity,"size"=>$size,"color"=>$color);
        Cart::cartAdd($arr);
         return redirect(url("cart"));
    }
    public function index(){
        $cart = Cart::cartList();
        return view("frontend.cart",["cart"=>$cart]);
    }
    public function remove($id){
        Cart::cartDelete($id);
        return redirect(url("cart"));
    }
    public function destroy(){
        Cart::cartDestroy();
        
        return redirect(url("cart"));
    }
    public function update( Request $request){
        $cart = Cart::cartList();
        $number=0;
        foreach($cart as $product){
            $key=$product['name'].$product['color'].$product['size'];
            $name="product_".$key;
            $new_quantity =$_POST[$number];
            Cart::cartUpdate($key,$new_quantity);
            $number++;
        }
        return redirect(url("cart"));
    }
    
}
