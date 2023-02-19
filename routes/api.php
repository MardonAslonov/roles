<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserClientController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware'=>["auth:api"]], function(){

        Route::group(['middleware'=>["role:api"]], function(){

            Route::post('user/client/create', [UserClientController::class, 'store']);

        });

        Route::post('product/create', [ProductController::class, 'store']);
        Route::post('user/create', [UserController::class, 'create']);
        
    });
