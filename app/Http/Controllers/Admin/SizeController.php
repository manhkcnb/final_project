<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Service\SizeService;

class SizeController extends Controller
{
    protected $sizeService;

    public function __construct(SizeService $sizeService)
    {
        $this->sizeService = $sizeService;
    }

    public function read(Request $request)
    {
        $data = $this->sizeService->getAllSizes();
        return view("Admin.size.read", compact("data"));
    }

    public function update(Request $request, $id)
    {
        $record = $this->sizeService->getById($id);
        $action = url("backend/size/updatePost/" . $id);
        return view("Admin.size.create_update", ["record" => $record, "action" => $action]);
    }

    public function updatePost(Request $request, $id)
    {
        $data = ["name" => $request->input("name")];
        $this->sizeService->update($id, $data);
        return redirect(url('backend/size'));
    }

    public function create(Request $request)
    {
        $action = url("backend/size/createPost");
        return view("Admin.size.create_update", ["action" => $action]);
    }

    public function createPost(Request $request)
    {
        $data = ["name" => $request->input("name")];
        $this->sizeService->create($data);
        return redirect(url('backend/size'));
    }

    public function delete(Request $request, $id)
    {
        // Delete related records first (product_if)
        // You should move this to the appropriate service/repository if necessary
        // ...

        $this->sizeService->delete($id);
        return redirect(url('backend/size'));
    }
}

