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

    public function getProductQuantity($size, $color)
    {
        $dataColor = Color::where("name", $color)->first();
        $dataSize = Size::where("name", $size)->first();

        $data = ProductIf::where("color_id", $dataColor->id)
            ->where("size_id", $dataSize->id)
            ->first();

        return isset($data) ? $data->quantity : 0;
    }

    public function updateProductQuantity($name, $size, $color, $quantity)
    {
        $dataColor = Color::where("name", $color)->first();
        $dataSize = Size::where("name", $size)->first();
        $dataName = Product::where("name", $name)->first();

        $data = ProductIf::where("product_id", $dataName->id)
            ->where("color_id", $dataColor->id)
            ->where("size_id", $dataSize->id)
            ->first();

        if (isset($data)) {
            ProductIf::where("id", $data->id)->update(['quantity' => $quantity]);
        } else {
            ProductIf::insert(['product_id' => $dataName->id, 'color_id' => $dataColor->id, 'size_id' => $dataSize->id, 'quantity' => $quantity]);
        }

        return view('admin.detail.detail', ['data' => $dataName, 'size' => $size, 'color' => $color, 'quantity' => $quantity]);
    }
}