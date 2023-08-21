<?php 
namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }
    public function getCategoryNameById($categoryId)
    {
        return $this->categoryRepository->getCategoryNameById($categoryId);
    }
    public function createCategory($categoryData)
    {
        return $this->categoryRepository->createCategory($categoryData);
    }

    public function updateCategory($id, $categoryData)
    {
        return $this->categoryRepository->updateCategory($id, $categoryData);
    }

    public function deleteCategory($id)
    {
        return $this->categoryRepository->deleteCategory($id);
    }
}


 ?>