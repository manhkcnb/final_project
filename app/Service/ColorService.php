<?php 
namespace App\Service;

use App\Repository\ColorRepository;

class ColorService
{
    protected $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function getAllColors()
    {
        return $this->colorRepository->getAllColors();
    }

    public function getColorById($id)
    {
        return $this->colorRepository->getColorById($id);
    }

    public function createColor($colorData)
    {
        return $this->colorRepository->createColor($colorData);
    }

    public function updateColor($id, $colorData)
    {
        return $this->colorRepository->updateColor($id, $colorData);
    }

    public function deleteColor($id)
    {
        return $this->colorRepository->deleteColor($id);
    }
}



 ?>