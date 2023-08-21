<?php
namespace App\Service;

use App\Repository\SizeRepository;

class SizeService
{
    protected $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function getAllSizes()
    {
        return $this->sizeRepository->getAllSizes();
    }

    public function getById($id)    
    {
        return $this->sizeRepository->getById($id);
    }

    public function update($id, $data)
    {
        $this->sizeRepository->update($id, $data);
    }

    public function create($data)
    {
        $this->sizeRepository->create($data);
    }

    public function delete($id)
    {
        $this->sizeRepository->delete($id);
    }
}
