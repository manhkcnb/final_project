<?php 
namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductIf;

class DetailRepository
{
    public function getProductDetail($id)
    {
        return Product::where("id", $id)->first();
    }

    public function getProductQuantity($size, $color,$name)
    {
        

        $data = ProductIf::where("color_id", $color)
            ->where("size_id", $size)->where("product_id",$name)
            ->first();

        return isset($data) ? $data->quantity : 0;
    }

    public function updateProductQuantity($name, $size, $color, $quantity)
    {
       
        $data = ProductIf::where("product_id", $name)
            ->where("color_id", $color)
            ->where("size_id", $size)
            ->first();
        

        if (isset($data)) {
            ProductIf::where("id", $data->id)->update(['quantity' => $quantity]);
        } else {
            ProductIf::insert(['product_id' => $name, 'color_id' => $color, 'size_id' => $size, 'quantity' => $quantity]);
        }

        // return view('admin.detail.detail', ['data' => $dataName, 'size' => $size, 'color' => $color, 'quantity' => $quantity]);
    }
}