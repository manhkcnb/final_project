<?php 
namespace App\Service;

use App\Repository\ProductRepository;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductsByItems($soluong)
    {
        return $this->productRepository->getProductsByItems($soluong);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function updateProduct($id, $data)
    {
        $this->productRepository->updateProduct($id, $data);
    }

    public function createProduct($data)
    {
        $this->productRepository->createProduct($data);
    }

    public function deleteProduct($id)
    {
        $this->productRepository->deleteProduct($id);
    }

    public function deleteProducts($ids)
    {
        $this->productRepository->deleteProducts($ids);
    }

    public function searchByKey($key)
    {
        return $this->productRepository->searchByKey($key);
    }

    public function allSoftDeleted()
    {
        return $this->productRepository->allSoftDeleted();
    }

    public function restoreProduct($id)
    {
        $this->productRepository->restoreProduct($id);
    }
}

 ?>