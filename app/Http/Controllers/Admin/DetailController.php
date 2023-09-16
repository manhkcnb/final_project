<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\DetailService;
use App\Service\CategoryService;

class DetailController extends Controller
{
    protected $detailService;

    public function __construct(DetailService $detailService)
    {
        $this->detailService = $detailService;
    }

    public function read($id,CategoryService $categoryService)
    {
        $data = $this->detailService->getProductDetail($id);
        // return view("admin.detail.detail", ["data" => $data]);
       
            $data->category_name = $categoryService->getCategoryNameById($data->category_id);
    
        return response()->json($data);
    }

    public function getQuantity(){
       
        $requestData = json_decode(file_get_contents("php://input"));
        $colorId = $requestData->color_id;
        $sizeId = $requestData->size_id;
        $name=$requestData->name_id;
        $quantity= $this->detailService->getProductQuantity($sizeId,$colorId,$name);
        return response()->json($quantity);
    }

    public function detailPost(Request $request)
    {   $requestData = json_decode(file_get_contents("php://input"));
        $colorId = $requestData->color_id;
        $sizeId = $requestData->size_id;
        $name=$requestData->name_id;
        $quantity=$requestData->quantity;
        // $name = $request->input("name");
        // $size = $request->input('size');
        // $color = $request->input('color');
        // $quantity = $request->input("quantity");
        $k= $this->detailService->updateProductQuantity($name,$sizeId,$colorId,$quantity);
        return response()->json($requestData);
    }
}
