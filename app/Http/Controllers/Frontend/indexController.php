<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class indexController extends Controller
{
    //
   
    public function index(){
        return view("frontend.index");
    }
    public static function getCategory(){
        $getCategory=DB::table("category")->orderBy("id","desc")->get();
        return $getCategory;
    }public static function getColor(){
        $getColor=DB::table("colors")->orderBy("id","desc")->get();
        return $getColor;
    }public static function getProduct(){
        $getColor=DB::table("products")->orderBy("id","asc")->paginate(12);
        return $getColor;
    }public static function readCategory($category_id){
        $category=DB::table("category")->where("id","=",$category_id)->first();
        return $category;
    }public static function getSize(){
         $getSize=DB::table("size")->orderBy("id","desc")->get();
        return $getSize;
    }public static function product_if($id){
        $product_if=DB::table("product_if")->where("product_id","=",$id)->orderBy("id","asc")->get();
        return $product_if;
    }public static function getsColor($id){
        $getColor=DB::table("colors")->where("id","=",$id)->orderBy("id","asc")->first();
        return $getColor;
    }public static function getsSize($id){
        $getSize=DB::table("size")->where("id","=",$id)->orderBy("id","asc")->first();
        return $getSize;
    }
}
