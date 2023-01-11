<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminHomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/', [HomeController::class, 'index']); // return fuc index from HomeController
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//AdminHomeController

route::get('/redirect', [HomeController::class, 'redirect']);
// hien thi category
route::get('/view_category', [AdminHomeController::class, 'view_category']);
// them (method post)
route::post('/add_category', [AdminHomeController::class, 'add_category']);
//xoa
route::get('/delete_category/{id}', [AdminHomeController::class, 'delete_category']); // id được gửi từ lúc load lên
// hien thi products
route::get('/view_product', [AdminHomeController::class, 'view_product']);
// them product (method post)
route::post('/add_product', [AdminHomeController::class, 'add_product']);
// hien thi san pham len view
route::get('/show_product', [AdminHomeController::class, 'show_product']);
// delete products
route::get('/delete_product/{id}', [AdminHomeController::class, 'delete_product']);
// update products
route::get('/update_product/{id}', [AdminHomeController::class, 'update_product']);
// finish update product
route::post('/update_product_confirm/{id}', [AdminHomeController::class, 'update_product_confirm']);
// order
Route::get('/order', [AdminHomeController::class, 'order']);

// HomeController

// show product details
route::get('/product_details/{id}', [HomeController::class, 'product_details']);
// add to cart
route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
// show cart
route::get('/show_cart', [HomeController::class, 'show_cart']);
// remove cart
route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);
// cash order
route::get('/cash_order', [HomeController::class, 'cash_order']);
// 
route::get('/stripe/{total_price}', [HomeController::class, 'stripe']);
//
Route::post('stripe/{total_price}', [HomeController::class, 'stripePost'])->name('stripe.post');
