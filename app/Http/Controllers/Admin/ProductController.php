<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ProductService;
use App\Service\CategoryService;

class ProductController extends Controller
{
    protected $productService;
    

    public function __construct(ProductService $productService )
    {
        $this->productService = $productService;
        
    }

     public function read(Request $request, CategoryService $categoryService)
    {
        $data = $this->productService->getAllProducts();
        foreach ($data as $product) {
            $product->category_name = $categoryService->getCategoryNameById($product->category_id);
        }
        return view("Admin.products.read", compact("data"));
    }
    

    public function readItems(Request $request ,CategoryService $categoryService)
    {
        $soluong = $request->input('soluong');

        $data = $this->productService->getProductsByItems($soluong);
         foreach ($data as $product) {
            $product->category_name = $categoryService->getCategoryNameById($product->category_id);
        }
        return view("Admin.products.read", compact("data", "soluong"));
    }

    public function update(Request $request, $id)
    {
        $record = $this->productService->getProductById($id);
        $action = url("backend/products/updatePost/" . $id);
        return view("Admin.products.create_update", ["record" => $record, "action" => $action]);
    }

    public function updatePost(Request $request, $id)
    {
        $data = [
            'name' => $request->input("name"),
            'category_id' => $request->input("category_id"),
            'price' => $request->input("price"),
            'photo' => $request->input("photo"),
        ];

        $this->productService->updateProduct($id, $data);

        return redirect(url('backend/products'));
    }

    public function create(Request $request)
    {
        $action = url("backend/products/createPost");
        return view("Admin.products.create_update", ["action" => $action]);
    }

    public function createPost(Request $request)
    {
        $data = [
            'name' => $request->input("name"),
            'category_id' => $request->input("category_id"),
            'price' => $request->input("price"),
            'photo' => $request->input("photo"),
        ];

        $this->productService->createProduct($data);

        return redirect(url('backend/products'));
    }

    public function delete(Request $request, $id)
    {
        $this->productService->deleteProduct($id);
        return redirect(url('backend/products'));
    }

    public function deleteItems(Request $request)
    {
        $items = $request->input('items', []);
        $this->productService->deleteProducts($items);
        return redirect(url('backend/products'));
    }

    public function searchKey(Request $request)
    {
        $key = $request->input("key");
        $data = $this->productService->searchByKey($key);
        return view("admin.products.searchKey", ["data" => $data, "key" => $key]);
    }

    public function allSoftDeleted(Request $request)
    {
        $data = $this->productService->allSoftDeleted();
        return view("admin.products.allSoftDeleted", ["data" => $data]);
    }

    public function restore($id)
    {
        $this->productService->restoreProduct($id);
        return redirect(url('backend/products/allSoftDeleted'));
    }

    public function deletes(Request $request, $id)
    {
        $this->productService->deleteProducts($id);
        return redirect(url('backend/products/allSoftDeleted'));
    }
}
