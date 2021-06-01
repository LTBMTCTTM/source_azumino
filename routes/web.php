<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GoodsHistoryController;
use App\Http\Controllers\ShippingDestinations;
use App\Http\Controllers\WorkersController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

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
Route::middleware(['auth.custom'])->group(function () {
    Route::redirect('/', '/goods-history')->name('/');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout']);
    Route::post('change-config', [LoginController::class, 'changeConfig'])->name('change.config');
    Route::post('change-password', [SiteController::class, 'store'])->name('change.password');

    Route::get('goods-history', [GoodsHistoryController::class, 'index'])->name('goods.history');
    Route::post('goods-history/search', [GoodsHistoryController::class, 'search'])->name('goods.history.search');
    Route::post('goods-history/delete', [GoodsHistoryController::class, 'delete'])->name('goods.history.delete');
    Route::post('goods-history/export', [GoodsHistoryController::class, 'export'])->name('goods.history.export');

    Route::get('shipping-destinations', [ShippingDestinations::class, 'index'])->name('shipping.destinations');
    Route::post('shipping-destinations/search', [ShippingDestinations::class, 'search'])->name('shipping.destinations.search');
    Route::post('shipping-destinations/detail', [ShippingDestinations::class, 'detail'])->name('shipping.destinations.detail');
    Route::post('shipping-destinations/delete', [ShippingDestinations::class, 'delete'])->name('shipping.destinations.delete');
    Route::post('shipping-destinations/update', [ShippingDestinations::class, 'update'])->name('shipping.destinations.update');

    Route::get('workers', [WorkersController::class, 'index'])->name('workers');
    Route::post('workers/search', [WorkersController::class, 'search'])->name('workers.search');
    Route::post('workers/detail', [WorkersController::class, 'detail'])->name('workers.detail');

    Route::get('file/download', [FileController::class, 'download'])->name('file.download');

});
