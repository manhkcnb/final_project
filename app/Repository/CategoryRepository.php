<?php 
namespace App\Repository;

use App\Models\Category;

class CategoryRepository
{
    public function getAllCategories()
    {
        return Category::orderBy('id', 'asc')->paginate(10);
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }
    public function getCategoryNameById($categoryId)
    {
        $category = Category::find($categoryId);
        if ($category) {
            return $category->name;
        }
        return null; 
    }
    public function createCategory($categoryData)
    {
        return Category::create($categoryData);
    }

    public function updateCategory($id, $categoryData)
    {
        $category = $this->getCategoryById($id);
        $category->update($categoryData);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);
        return $category->delete();
    }
}

 ?>