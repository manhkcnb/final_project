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



use App\Http\Controllers\Frontend\IndexController;

Route::get('/', [IndexController::class,'getProduct']);
Route::get('backend', function () {
    return view('admin.home.read');
})->middleware("check_login");

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



use App\Http\Controllers\Frontend\ProductController as ProductFrontend;
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






