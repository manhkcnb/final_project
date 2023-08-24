<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Frontend\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function search(Request $request) {
        $key = $request->input("key");
        $data = $this->productService->searchByName($key, 8);
        return view("frontend.product_search", ["key" => $key, "data" => $data]);
    }

    public function searchPrice(Request $request) {
        $min = intval($request->input("min_price"));
        $max = intval($request->input("max_price"));

        $data = $this->productService->searchByPriceRange($min, $max, 8);
        return view("frontend.product_searchPrice", ["min" => $min, "max" => $max, "data" => $data]);
    }

    public function detail($id) {
        $data = $this->productService->getProductDetail($id);
        return view("frontend.detail", ["data" => $data]);
    }

    public function category($id) {
        $data = $this->productService->getProductsByCategory($id);
        return view("frontend.product_search", ["data" => $data]);
    }

    public function color($id) {
        $check = $this->productService->getProductsByColor($id);
        return view("frontend.product_searchsizecolor", ["check" => $check]);
    }

    public function size($id) {
        $check = $this->productService->getProductsBySize($id);
        return view("frontend.product_searchsizecolor", ["check" => $check]);
    }
}
