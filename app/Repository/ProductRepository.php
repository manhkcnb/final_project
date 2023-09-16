<?php 
namespace App\Repository;

use App\Models\Product;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::orderBy('id', 'desc')->get();
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
    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);
        if ($product) {
            $product->forceDelete();
        }
    }

    public function deleteProducts($ids)
    {
        Product::whereIn('id', $ids)->delete();
    }

    public static function getCategoryName($category_id)
    {
       
        $record = DB::table("category")->where("id", "=", $category_id)->first();
        return $record->name;
    }

    public function searchByKey($key)
    {
        
        if($key!='') return Product::where("name", "like",'%'.$key.'%')->get();
        else return Product::get();
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