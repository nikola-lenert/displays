<?php

use App\Http\Controllers\DisplayController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'file'], function () {
    Route::get('{id}', [FileController::class, 'fetch'])->name('file.fetch');
});

Route::group(['prefix' => 'display'], function () {
    Route::get('setup', [DisplayController::class, 'getSetup']);
    Route::get('', [DisplayController::class, 'get']);
    Route::post('', [DisplayController::class, 'store']);
    Route::get('{id}', [DisplayController::class, 'fetch']);
    Route::delete('{id}', [DisplayController::class, 'delete']);
});
