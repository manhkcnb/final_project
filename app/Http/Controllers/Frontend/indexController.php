<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\Frontend\IndexService;

class IndexController extends Controller
{
    protected $indexService;

    public function __construct(IndexService $indexService) {
        $this->indexService = $indexService;
    }
    public  function getProduct() {
        $products = $this->indexService->getProduct();
        return view("frontend.products", ["products" => $products]);
    }


    public  function  getCategory() {
        $categories = $this->indexService->getCategory();
        return view("frontend.categories", ["categories" => $categories]);
    }

    public   function getColor() {
        $colors = $this->indexService->getColor();
        return view("frontend.colors", ["colors" => $colors]);
    }

   
    public  function readCategory($category_id) {
        $category = $this->indexService->readCategory($category_id);
        return view("frontend.category_detail", ["category" => $category]);
    }

    public  function getSize() {
        $sizes = $this->indexService->getSize();
        return view("frontend.sizes", ["sizes" => $sizes]);
    }

    public  function getProductIf($id) {
        $productIf = $this->indexService->getProductIf($id);
        return view("frontend.product_if", ["productIf" => $productIf]);
    }

    public  function getColorById($id) {
        $color = $this->indexService->getColorById($id);
        return view("frontend.color_detail", ["color" => $color]);
    }

    public  function getSizeById($id) {
        $size = $this->indexService->getSizeById($id);
        return view("frontend.size_detail", ["size" => $size]);
    }
}
