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

    public function getProductQuantity()
    {
        $size = request()->input('size');
        $color = request()->input('color');
        
        $quantity = $this->detailRepository->getProductQuantity($size, $color);

        return response()->json(['quantity' => $quantity]);
    }

    public function updateProductQuantity(Request $request)
    {
        $name = $request->input("name");
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input("quantity");

        return $this->detailRepository->updateProductQuantity($name, $size, $color, $quantity);
    }
}


 ?>