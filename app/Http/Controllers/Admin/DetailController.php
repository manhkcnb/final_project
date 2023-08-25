<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\DetailService;

class DetailController extends Controller
{
    protected $detailService;

    public function __construct(DetailService $detailService)
    {
        $this->detailService = $detailService;
    }

    public function read($id)
    {
        $data = $this->detailService->getProductDetail($id);
        return view("admin.detail.detail", ["data" => $data]);
    }

    public function getQuantity()
    {
        return $this->detailService->getProductQuantity();
    }

    public function detailPost(Request $request)

    {   
        $name = $request->input("name");
        $size = $request->input('size');
        $color = $request->input('color');
        $quantity = $request->input("quantity");
        return $this->detailService->updateProductQuantity($name,$size,$color,$quantity);
    }
}
