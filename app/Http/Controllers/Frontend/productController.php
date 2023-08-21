<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class productController extends Controller
{
    //
    public function search(Request $request){
        $key= Request("key");
        $data = DB::table("products")->where("name","like",'%'.$key.'%')->paginate(8);
        //print_r($data);
        return view("frontend.product_search",["key"=>$key,"data"=>$data]);

    }
    public function searchPrice(Request $request){
        $min = intval(Request("min_price"));
        $max = intval(Request("max_price"));

        $data = DB::table("products")->where("price",">",$min)->where("price","<",$max)->paginate(8);

        //print_r($data);
        return view("frontend.product_searchPrice",["min"=>$min,"max"=>$max,"data"=>$data]);

    }
    public function detail($id){
        $data=DB::table("products")->where("id","=",$id)->first();
        return view("frontend.detail",["data"=>$data]);
    }
    public function category($id){
        $data = DB::table("products")->where("category_id","=",$id)->get();

        return view("frontend.product_search",["data"=>$data]);

    }
    public function color($id){
        $data = DB::table("product_if")->where("color_id","=",$id)->get();
        $check=[];
        foreach( $data as $row)
        if(!in_array($row->product_id,$check)){
            $check[]=$row->product_id;
        }
         return view("frontend.product_searchsizecolor",["check"=>$check]);
        


     }
     public function size($id){
        $data = DB::table("product_if")->where("size_id","=",$id)->get();
        $check=[];
        foreach( $data as $row)
        if(!in_array($row->product_id,$check)){
            $check[]=$row->product_id;
        }
         return view("frontend.product_searchsizecolor",["check"=>$check]);
        


     }
}
