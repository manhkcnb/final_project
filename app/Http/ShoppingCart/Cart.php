<?php

namespace App\Http\ShoppingCart;

use Illuminate\Support\Facades\Session;

use DB;

trait Cart {

    public static function cartAdd($arr){
        $cart = Session::get('cart');
        $key=$arr['name'].$arr['color'].$arr['size'];

        if(isset($cart[$key])){
            $cart[$key]['quantity']+=$arr['quantity'];
        }else {
           
            $cart[$key] = $arr; 
        } 
        Session::put('cart', $cart);
        if(session()->has('customer_email')){
          $email=session()->get('customer_email');
          $data=DB::table("cart")->where("customer_email","=",$email)->orderBy("id","desc")->get();
          $check=0;
          foreach($data as $row){
            $kk=$row->name.$row->color.$row->size;
            if($kk==$key){
                DB::table("cart")->where("id","=",$row->id)->increment('quantity',$arr['quantity']);
                $check=1;
                break;
            }
            
          }if($check==0){
            DB::table("cart")->insert(["customer_email"=>$email,"name"=>$arr['name'],"color"=>$arr['color'],"size"=>$arr['size'],"price"=>$arr['price'],"quantity"=>$arr['quantity'],"photo"=>$arr['photo']]);
          } 
        }
    
        

    }

    public static function cartAddWithNumber($id, $quantity){
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $quantity;
        } else {
            $product = Product::find($id);
            $cart[$id] = [
                'id' => $id,
                'name' => $product->name,
                'photo' => $product->photo,
                'quantity' => $quantity,
                'price' => $product->price,
    
            ];
        }
        Session::put('cart', $cart);
    }

    public static function cartUpdate($id, $quantity){
        $cart = Session::get('cart');

        if($quantity == 0){

            unset($cart[$id]);
            if(session()->has('customer_email')){
                  $email=session()->get('customer_email');
                  $data=DB::table("cart")->where("customer_email","=",$email)->orderBy("id","desc")->get();
                  
                  foreach($data as $row){
                    $kk=$row->name.$row->color.$row->size;
                    if($kk==$id){
                        DB::table("cart")->where("id","=",$row->id)->update(['quantity'=>$quantity]);
                        DB::table("cart")->where("id","=",$row->id)->delete();
                        
                        break;
                    }
                }
            
          } 
        }

        else {
            $cart[$id]['quantity'] = $quantity;
            if(session()->has('customer_email')){
                  $email=session()->get('customer_email');
                  $data=DB::table("cart")->where("customer_email","=",$email)->orderBy("id","desc")->get();
                  
                  foreach($data as $row){
                    $kk=$row->name.$row->color.$row->size;
                    if($kk==$id){
                        DB::table("cart")->where("id","=",$row->id)->update(['quantity'=>$quantity]);
                     
                        
                        break;
                    }
            
                  } 
            }
        }
        Session::put('cart', $cart);
    }

    public static function cartDelete($id){
        $cart = Session::get('cart');
        if(session()->has('customer_email')){
            $email=session()->get('customer_email');
            DB::table("cart")->where("customer_email","=",$email)->where("name","=",$cart[$id]['name'])->where("color","=",$cart[$id]['color'])->where("size","=",$cart[$id]['size'])->delete();
        }

       
        unset($cart[$id]);
        Session::put('cart', $cart);
    }

    public static function cartTotal(){
        $cart = Session::get('cart');
        $total = 0;
        if($cart != ""){
            foreach($cart as $product){
                $total += ($product['price']) * $product['quantity'];
            }
        }
        return $total;
    }

    public static function cartNumber(){
        $cart = Session::get('cart');
        $number = 0;
        if(isset($cart)){
            foreach($cart as $product){
                $number += $product['quantity'];
            }
        }
        return $number;
    }

    public static function cartList(){
        $cart = Session::get('cart');
        return $cart;
    }

    public static function cartDestroy(){

        Session::forget('cart');
        if(session()->has('customer_email')){
            $email=session()->get('customer_email');
            DB::table("cart")->where("customer_email","=",$email)->delete();
        }
    }

        // public static function cartOrder(){
        //     //$customer = Session::get('customer');
        //     $customer_id = Session::get('customer_id');
           
        //     //---
        //     $cart = Session::get('cart');

        //     // Insert record into orders table
        //     $orderId = DB::table('orders')->insertGetId([
        //         'customer_id' => $customer_id,
        //         'price' => \App\Http\ShoppingCart\Cart::cartTotal(),
        //         'status' => 0,
        //         'date' => now(),
        //     ]);

        //     // Insert record into order_details table
        //     foreach ($cart as $product) {
        //         //tính lại giá thành sản phẩm sau khi giảm giá
        //         $price = $product['price'] - ($product['price'] * $product['discount'])/100;
        //         DB::table('order_details')->insert([
        //             'order_id' => $orderId,
        //             'product_id' => $product['id'],
        //             'quantity' => $product['quantity'],
        //             'price' => $price,
        //         ]);
        //     }

        //     // Clear cart
        //     Session::forget('cart');
        // }

}       
