<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\ColorService;

class ColorController extends Controller
{
    protected $colorService;

    public function __construct(ColorService $colorService)
    {
        $this->colorService = $colorService;
    }

    public function read(Request $request)
    {
        $data = $this->colorService->getAllColors();
        return  response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $record = $this->colorService->getColorById($id);
        $action = url('backend/color/updatePost/'.$id);
        return  response()->json($record);
    }

    public function updatePost(Request $request, $id)
    {
        $colorData = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $this->colorService->updateColor($id, $colorData);

    //     return redirect(url('backend/color'));
    }

    public function create(Request $request)
    {
        $action = url('backend/color/createPost');
        // return view("admin.color.create_update", ["action" => $action]);
    }

    public function createPost(Request $request)
    {
        $colorData = [
            'name' => $request->input('name'),
            'code' => $request->input('code'),
        ];

        $this->colorService->createColor($colorData);

        // return redirect(url('backend/color'));
    }

    public function delete(Request $request, $id)
    {
        $this->colorService->deleteColor($id);
        // return redirect(url('backend/color'));
    }
}
