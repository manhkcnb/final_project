<?php 
namespace App\Repository\Frontend;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\ProductIf;

class IndexRepository {
    public function getCategory() {
        return Category::orderBy("id", "desc")->get();
    }

    public function getColor() {
        return Color::orderBy("id", "desc")->get();
    }

    public function getProduct() {
        return Product::orderBy("id", "asc")->paginate(12);
    }

    public function readCategory($category_id) {
        return Category::where("id", "=", $category_id)->first();
    }

    public function getSize() {
        return Size::orderBy("id", "desc")->get();
    }

    public function getProductIf($id) {
        return ProductIf::where("product_id", "=", $id)->orderBy("id", "asc")->get();
    }

    public function getColorById($id) {
        return Color::where("id", "=", $id)->orderBy("id", "asc")->first();
    }

    public function getSizeById($id) {
        return Size::where("id", "=", $id)->orderBy("id", "asc")->first();
    }
}


 ?>