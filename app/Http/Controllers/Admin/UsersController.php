<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Service\UserService;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function read(Request $request)
    {
        $data = $this->userService->getAllUsers();
        return view("admin.users.read", compact('data'));
    }

    public function update(Request $request, $id)
    {
        $record = $this->userService->getUserById($id);
        $action = url('backend/users/update-post/'.$id);
        return view("admin.users.create_update", ["record" => $record, "action" => $action]);
    }

    public function updatePost(Request $request, $id)
    {
        $userData['name']=$request->get('name');
       
        if ($request->get('password')) {
            $userData['password'] = bcrypt($request->get('password'));
        }

        $this->userService->updateUser($id, $userData);

        return redirect(url('backend/users'));
    }

    public function create(Request $request)
    {
        $action = url('backend/users/create-post');
        return view("admin.users.create_update", ["action" => $action]);
    }

    public function createPost(Request $request)
    {
        $userData = [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ];

        $this->userService->createUser($userData);

        return redirect(url('backend/users'));
    }

    public function delete(Request $request, $id)
    {
        $this->userService->deleteUser($id);
        return redirect(url('backend/users'));
    }
}
