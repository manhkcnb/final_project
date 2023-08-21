<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\Admin\AdminController;

Route::get('backend/login', function () {
    return view('admin.login.form_login');
});
Route::get('backend/login',[AdminController::class,'login']);
Route::post('backend/login-post',[AdminController::class,'loginPost'] );
Route::get('backend/forgotpassword',[AdminController::class,'forgotPassword']);
Route::post('backend/forgotPasswordPost',[AdminController::class,'forgotPasswordPost']);
Route::post('backend/resetPost',[AdminController::class,'resetPassword']);
Route::post('backend/passwordNew',[AdminController::class,'passwordNew']);
Route::get('backend/logout', function () {
    Auth::logout();
    return redirect(url('backend/login'));
});

Route::get('/', function () {
    return view('frontend/products');
});
Route::get('backend', function () {
    return view('admin.home.read');
})->middleware("check_login");
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
Route::post('backend/category/createPpost',[CategoryController::class,'createPost']);
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
Route::get('get-quantity', [DetailController::class,'getQuantity']);
Route::post("backend/detailPost",[DetailController::class,'detailPost']);






use App\Http\Controllers\Frontend\productController as ProductFrontend;
Route::get("/search",[ProductFrontend::class,'search']);
Route::get("/searchPrice",[ProductFrontend::class,'searchPrice']);
Route::get('detail/{id}',[ProductFrontend::class,'detail']);
Route::get('category/{id}',[ProductFrontend::class,'category']);
Route::get('color/{id}',[ProductFrontend::class,'color']);
Route::get('size/{id}',[ProductFrontend::class,'size']);


use App\Http\Controllers\Frontend\CustomersController;
Route::get('/login',[CustomersController::class,'login']);
Route::post('/login-post',[CustomersController::class,'loginPost']);
Route::get('/register',[CustomersController::class,'register']);
Route::post('/register-post',[CustomersController::class,'registerPost']);
Route::get('/logout',[CustomersController::class,'logout']);

use \App\Http\Controllers\Frontend\CartController;

Route::get('cart',[CartController::class,'index']);
Route::get('cart/buy/{id}',[CartController::class,'buy']);
Route::get('cart/remove/{id}',[CartController::class,'remove']);
Route::get('cart/destroy',[CartController::class,'destroy']);
Route::post('cart/update',[CartController::class,'update']);

Route::get('cart/order',[CartController::class,'order']);
Route::post('detailPost',[CartController::class,'buy']);
use \App\Http\Controllers\Frontend\Forgotpassword;
Route::get('forgotpassword',[Forgotpassword::class,'forgotPassword']);
Route::post('forgotpasswordPost',[Forgotpassword::class,'forgotpasswordPost']);
Route::post('resetPost',[Forgotpassword::class,'resetPassword']);
Route::post('passwordNew',[Forgotpassword::class,'passwordNew']);






