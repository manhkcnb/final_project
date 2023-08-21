<?php 
namespace App\Repository;

use Illuminate\Support\Facades\DB;
use App\Models\ProductDetail;


class DetailRepository
{
    public function getProductDetail($id)
    {
        return ProductDetail::where("id", $id)->first();
    }

    public function getProductQuantity($size, $color)
    {
        $dataColor = DB::table('colors')->where("name", $color)->first();
        $dataSize = DB::table("size")->where("name", $size)->first();

        $data = DB::table("product_if")
            ->where("color_id", $dataColor->id)
            ->where("size_id", $dataSize->id)
            ->first();

        return isset($data) ? $data->quantity : 0;
    }

    public function updateProductQuantity($name, $size, $color, $quantity)
    {
        $dataColor = DB::table('colors')->where("name", $color)->first();
        $dataSize = DB::table("size")->where("name", $size)->first();
        $dataName = DB::table("products")->where("name", $name)->first();

        $data = DB::table("product_if")
            ->where("product_id", $dataName->id)
            ->where("color_id", $dataColor->id)
            ->where("size_id", $dataSize->id)
            ->first();

        if (isset($data)) {
            DB::table("product_if")->where("id", $data->id)->update(['quantity' => $quantity]);
        } else {
            DB::table("product_if")->insert(['product_id' => $dataName->id, 'color_id' => $dataColor->id, 'size_id' => $dataSize->id, 'quantity' => $quantity]);
        }

        return view('admin.detail.detail', ['data' => $dataName, 'size' => $size, 'color' => $color, 'quantity' => $quantity]);
    }
}