<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginationController extends Controller
{
    public function setPaginationOption(Request $request)
    {
        $selectedOption = $request->input('selectedOption');
        session(['selectedOption' => $selectedOption]);

        // Trả về dữ liệu phân trang mới cho trang web bằng cách gọi hàm truy vấn dữ liệu và trả về view phân trang mới.
        // Ví dụ: 
        // $data = DB::table("products")->orderBy("id", "asc")->paginate($selectedOption);
        // return view('products.index', ['data' => $data]);

        // Hoặc nếu bạn đã có dữ liệu phân trang trong session, bạn có thể gọi hàm cập nhật dữ liệu phân trang tại đây và trả về view phân trang mới.
        // Ví dụ:
        // $data = $this->updatePaginationData($selectedOption);
        // return view('products.index', ['data' => $data]);
    }
}
