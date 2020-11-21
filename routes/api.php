<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\ProductController;

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

Route::middleware(['api'])->group(function () {
    Route::prefix('stores')->group(function () {
        Route::get('', [StoreController::class, 'index']);
        Route::prefix('store/{store}')->group(function () {
            Route::get('lookup', [StoreController::class, 'lookup']);
        });
    });

    Route::prefix('products')->group(function () {
        Route::put('product/{store}', [ProductController::class, 'store']);
        Route::delete('product/{product}', [ProductController::class, 'destroy']);
        Route::get('list', [ProductController::class, 'index']);
    });
});
