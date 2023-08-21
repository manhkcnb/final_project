<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use DB;

class CustomersController extends Controller
{
    public function login(){
        return view("frontend.login");
    }
    public function loginPost(){
        $email = request()->get("email");
        $password = request()->get("password");
        $record = DB::table("users")->where("email","=",$email)->first();
        
        if(isset($record->email)){
            if(Hash::check($password,$record->password)){
                session()->put("customer_email",$record->email);
                if(session()->has('cart')){
                    $cart =session()->get('cart');
                    foreach($cart as $row){
                        $datas=DB::table("cart")->where("customer_email","=",$record->email)->where('name',"=",$row["name"])->where('color',"=",$row["color"])->where('size',"=",$row["size"])->first();
                        if(isset($datas)){
                            DB::table("cart")->where("customer_email","=",$record->email)->where('name',"=",$row["name"])->where('color',"=",$row["color"])->where('size',"=",$row["size"])->increment('quantity',$row['quantity']);
                        }else{
                            DB::table("cart")->insert(["customer_email"=>$record->email,"name"=>$row["name"],"color"=>$row["color"],"size"=>$row["size"],"price"=>$row["price"],"quantity"=>$row["quantity"],"photo"=>$row["photo"]]);
                        }               
                    }
                }
                $data=DB::table("cart")->where("customer_email","=",$record->email)->orderBy("id","desc")->get();
                foreach($data as $row){
                    $arr=array("name"=>$row->name,"photo"=>$row->photo,"price"=>$row->price,"quantity"=>$row->quantity,"size"=>$row->size,"color"=>$row->color);
                    $cart = session()->get('cart');
                    $keys=$arr['name'].$arr['color'].$arr['size'];
                    $cart[$keys] = $arr;
                    session()->put('cart', $cart);
                }
                return redirect(url(''));
            }
        }
        return redirect(url('login?notify=invalid'));
    }
    public function register(){
        return view("frontend.register");
    }
    public function registerPost(){
        $email = request()->get("email");
        $password = request()->get("password");
        $password = Hash::make($password);
        $name = request()->get("name");
        $phone = request()->get("phone");
        $address = request()->get("address");
        //kiểm tra xem email đã tồn tại chưa, nếu chưa thì mới cho insert
        
        $check1 = DB::table("users")->where("email","=",$email)->first();
        if(!isset($check1->email)){
            DB::table("users")->insert(["email"=>$email,"name"=>$name,'password'=>$password,"role"=>"3"]);
        }
        else
            return redirect(url('customers/register?notify=invalid'));
        return redirect(url('login'));
    }
    public function logout(){
        session()->remove("cart");
        session()->remove("customer_email");
        session()->remove("customer_id");
        return redirect(url(''));
    }
}
