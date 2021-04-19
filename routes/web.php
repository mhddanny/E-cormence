<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukWebController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProdukController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produks', [ProdukWebController::class, 'index'])->name('web.produk');
Route::get('/shop/{produk}', [ProdukWebController::class, 'produkDetail'])->name('produkDetail');
Route::get('/category/{slug}', [ProdukWebController::class, 'categoryProduk'])->name('web.category');

Route::get('cart', [CartController::class, 'listCart'])->name('listCart');
Route::post('/cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update_card');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('remove_card');

Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');

Route::get('/login', function () {
    return redirect('login');
});

Route::match(["get","post"],"/register", function(){
    return redirect('login');
})->name("register");

Auth::routes();
// Route::middleware('auth')->group(function(){
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checklevel:admin']], function() {
  // Route::get('dashboard', DashboardController::class)->name('dashboard');
  Route::resource('user',  UserController::class);
  // Route::resource('category', CategoryController::class)->except(['show']);
  // Route::resource('produk', ProdukController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'checklevel:admin,staff']], function() {
  Route::get('dashboard', DashboardController::class)->name('dashboard');
  Route::resource('category', CategoryController::class)->except(['show']);
  Route::resource('produk', ProdukController::class);
});
