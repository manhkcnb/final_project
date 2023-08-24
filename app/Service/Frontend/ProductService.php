<?php 
namespace App\Service\Frontend;

use App\Repository\Frontend\ProductRepository;

class ProductService {
    protected $productRepository;

    public function __construct(ProductRepository $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function searchByName($key, $perPage) {
        return $this->productRepository->searchByName($key, $perPage);
    }

    public function searchByPriceRange($min, $max, $perPage) {
        return $this->productRepository->searchByPriceRange($min, $max, $perPage);
    }

    public function getProductDetail($id) {
        return $this->productRepository->findById($id);
    }

    public function getProductsByCategory($id) {
        return $this->productRepository->findByCategory($id);
    }

    public function getProductsByColor($id) {
        return $this->productRepository->findByColor($id);
    }

    public function getProductsBySize($id) {
        return $this->productRepository->findBySize($id);
    }
}


 ?>