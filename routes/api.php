<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\Api\CategoriController;
use App\Http\Controllers\Api\ProdukController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login_user', [LoginController::class,'login_user'] );
Route::get('user', [LoginController::class,'get_user'] );
Route::get('get_categori', [CategoriController::class, 'get_all']);

Route::apiResource('produk', ProdukController::class);

// Route::prefix('v1')->group(function(){
//   Route::apiResource('/user', UserController::class)
//       ->only(['show', 'store', 'update', 'destroy']);
//
//   Route::apiResource('people', UserController::class);
// });
