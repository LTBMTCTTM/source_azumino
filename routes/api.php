<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;

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
define("API_VERSION", "v1");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => API_VERSION], function ($router) {
    Route::post('/home', [HomeController::class, 'index']);
    Route::post('/workers', [HomeController::class, 'getWorkers'])->name('workers.get');
    Route::post('/ship-dest', [HomeController::class, 'getShipdes'])->name('ship-dest.get');
    Route::post('/ship-regist', [HomeController::class, 'sendData'])->name('ship-regist.get');

});
