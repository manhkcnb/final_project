<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('backend/login', function () {
    return view('admin.login.form_login');
});
use App\Http\Controllers\Admin\AdminController;
Route::get('backend/login',[AdminController::class,'login']);
Route::post('backend/loginPost',[AdminController::class,'loginPost'] );
Route::get('backend/forgotpassword',[AdminController::class,'forgotPassword']);
Route::post('backend/forgotPasswordPost',[AdminController::class,'forgotPasswordPost']);
Route::post('backend/resetPost',[AdminController::class,'resetPassword']);
Route::post('backend/passwordNew',[AdminController::class,'passwordNew']);
Route::get('backend/logout', function () {
    Auth::logout();
    return redirect(url('backend/login'));
});
use App\Http\Controllers\Admin\UsersController;
//read
Route::get('backend/users',[UsersController::class,'read']);
//create
Route::get('backend/users/create',[UsersController::class,'create']);
//create post
Route::post('backend/users/create-post',[UsersController::class,'createPost']);
//update
Route::get('backend/users/update/{id}',[UsersController::class,'update']);
//update post
Route::post('backend/users/update-post/{id}',[UsersController::class,'updatePost']);
//delete
Route::get('backend/users/delete/{id}',[UsersController::class,'delete']);


use App\Http\Controllers\Admin\CategoryController;
Route::get("backend/category",[CategoryController::class,'read']);
Route::get('backend/category/create',[CategoryController::class,'create']);
//create post
Route::post('backend/category/createpost',[CategoryController::class,'createPost']);
//update
Route::get('backend/category/update/{id}',[CategoryController::class,'update']);
//update post
Route::post('backend/category/updatePost/{id}',[CategoryController::class,'updatePost']);
Route::get('backend/category/delete/{id}',[CategoryController::class,'delete']);
////
use App\Http\Controllers\Admin\ProductController;
Route::get("backend/products",[ProductController::class,'read']);
Route::get('backend/products/create',[ProductController::class,'create']);
//create post
Route::post('backend/products/createPost',[ProductController::class,'createPost']);
//update
Route::get('backend/products/update/{id}',[ProductController::class,'update']);
//update post
Route::post('backend/products/updatePost/{id}',[ProductController::class,'updatePost']);
Route::get('backend/products/delete/{id}',[ProductController::class,'delete']);
Route::post('backend/products/deleteItems',[ProductController::class,'deleteItems']);
Route::get('soluongItems',[ProductController::class,'readItems']);
Route::post('backend/products/searchKey',[ProductController::class,'searchKey']);
Route::get('backend/products/allSoftDeleted',[ProductController::class,'allSoftDeleted']);
Route::get('backend/products/restore/{id}',[ProductController::class,'restore']);
Route::get('backend/products/deletes/{id}',[ProductController::class,'deletes']);



use App\Http\Controllers\Admin\SizeController;
Route::get("backend/size",[SizeController::class,'read']);
Route::get('backend/size/create',[SizeController::class,'create']);
//create post
Route::post('backend/size/createPost',[SizeController::class,'createPost']);
//update
Route::get('backend/size/update/{id}',[SizeController::class,'update']);
//update post
Route::post('backend/size/updatePost/{id}',[SizeController::class,'updatePost']);
Route::get('backend/size/delete/{id}',[SizeController::class,'delete']);
use App\Http\Controllers\Admin\ColorController;
Route::get("backend/color",[ColorController::class,'read']);
Route::get('backend/color/create',[ColorController::class,'create']);
//create post
Route::post('backend/color/createPost',[ColorController::class,'createPost']);
//update
Route::get('backend/color/update/{id}',[ColorController::class,'update']);
//update post
Route::post('backend/color/updatePost/{id}',[ColorController::class,'updatePost']);
Route::get('backend/color/delete/{id}',[ColorController::class,'delete']);
use App\Http\Controllers\Admin\DetailController;
Route::get("backend/detail/{id}",[DetailController::class,'read']);
Route::post('get-quantity', [DetailController::class,'getQuantity']);
Route::post("backend/detailPost",[DetailController::class,'detailPost']);

