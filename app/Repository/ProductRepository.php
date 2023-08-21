<?php 
namespace App\Repository;

use App\Models\Admin\Product;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::orderBy('id', 'desc')->paginate(50);
    }

    public function getProductsByItems($soluong)
    {
        return Product::orderBy('id', 'desc')->paginate($soluong);
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function updateProduct($id, $data)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }
    }

    public function createProduct($data)
    {
        Product::create($data);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
    }

    public function deleteProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();
    }

    public static function getCategoryName($category_id)
    {
        // Chuyển phần này sang Model Category nếu cần
        $record = DB::table("category")->where("id", "=", $category_id)->first();
        return $record->name;
    }

    public function searchByKey($key)
    {
        return Product::where("name", "like", '%' . $key . '%')->paginate(10);
    }

    public static function allSoftDeleted()
    {
        return Product::onlyTrashed()->get();
    }

    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->find($id);
        if ($product) {
            $product->restore();
        }
    }
}

 ?>