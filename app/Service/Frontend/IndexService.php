<?php 
namespace App\Service\Frontend;

use App\Repository\Frontend\IndexRepository;

class IndexService {
    protected $indexRepository;

    public function __construct(IndexRepository $indexRepository) {
        $this->indexRepository = $indexRepository;
    }

    public function getCategory() {
        return $this->indexRepository->getCategory();
    }

    public function getColor() {
        return $this->indexRepository->getColor();
    }

    public function getProduct() {
        return $this->indexRepository->getProduct();
    }

    public function readCategory($category_id) {
        return $this->indexRepository->readCategory($category_id);
    }

    public function getSize() {
        return $this->indexRepository->getSize();
    }

    public function getProductIf($id) {
        return $this->indexRepository->getProductIf($id);
    }

    public function getColorById($id) {
        return $this->indexRepository->getColorById($id);
    }

    public function getSizeById($id) {
        return $this->indexRepository->getSizeById($id);
    }
}

 ?>