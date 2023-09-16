<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function read(Request $request)
    {
        $data = $this->categoryService->getAllCategories();
        return  response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $record = $this->categoryService->getCategoryById($id);
        $action = url('backend/category/updatePost/'.$id);
        return  response()->json($record);
    }

    public function updatePost(Request $request, $id)
    {
        $categoryData = [
            'name' => $request->input('name'),
        ];

        $this->categoryService->updateCategory($id, $categoryData);

        // return redirect(url('backend/category'));
    }

    public function create(Request $request)
    {
        $action = url('backend/category/createPost');
        // return view("admin.categories.create_update", ["action" => $action]);
    }

    public function createPost(Request $request)
    {
        $categoryData = [
            'name' => $request->input('name'),
        ];

        $this->categoryService->createCategory($categoryData);

        // return redirect(url('backend/category'));
    }

    public function delete(Request $request, $id)
    {
        $this->categoryService->deleteCategory($id);
        // return redirect(url('backend/category'));
    }
}
