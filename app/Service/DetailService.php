<?php 
namespace App\Service;

use Illuminate\Support\Facades\DB;
use App\Repository\DetailRepository;

class DetailService
{
    protected $detailRepository;

    public function __construct(DetailRepository $detailRepository)
    {
        $this->detailRepository = $detailRepository;
    }

    public function getProductDetail($id)
    {
        return $this->detailRepository->getProductDetail($id);
    }

    public function getProductQuantity($size,$color,$name)
    {
        
        $quantity = $this->detailRepository->getProductQuantity($size, $color,$name);

        return $quantity;
    }

    public function updateProductQuantity($name,$size,$color,$quantity)
    {
        

        $this->detailRepository->updateProductQuantity($name, $size, $color, $quantity);

    }
}


 ?>