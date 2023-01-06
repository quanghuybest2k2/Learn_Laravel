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
