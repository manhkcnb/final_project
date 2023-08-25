 <?php 
namespace App\Repository\Frontend;

use App\Models\Product;
use App\Models\ProductIf;

class ProductRepository {
    public function searchByName($key, $perPage) {
        return Product::where("name", "like", '%' . $key . '%')->paginate($perPage);
    }

    public function searchByPriceRange($min, $max, $perPage) {
        return Product::where("price", ">", $min)->where("price", "<", $max)->paginate($perPage);
    }

    public function findById($id) {
        return Product::find($id);
    }

    public function findByCategory($id) {
        return Product::where("category_id", "=", $id)->get();
    }

    public function findByColor($id) {
        $data = ProductIf::where("color_id", "=", $id)->get();
        $check = [];
        foreach ($data as $row) {
            if (!in_array($row->product_id, $check)) {
                $check[] = $row->product_id;
            }
        }
        return $check;
    }

    public function findBySize($id) {
        $data = ProductIf::where("size_id", "=", $id)->get();
        $check = [];
        foreach ($data as $row) {
            if (!in_array($row->product_id, $check)) {
                $check[] = $row->product_id;
            }
        }
        return $check;
    }
}
