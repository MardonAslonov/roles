<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChiefController;
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

Route::post('user/create', [UserController::class, 'create']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware'=>["auth:api"]], function(){

    Route::group(['middleware'=>["worker:api"]], function(){

        Route::post('user/client/create', [UserClientController::class, 'store']);
        Route::get('user/client/show', [UserClientController::class, 'show']);
        Route::get('user/client/index', [UserClientController::class, 'index']);
        Route::get('user/client/delete', [UserClientController::class, 'destroy']);
        Route::post('user/client/update', [UserClientController::class, 'update']);
        Route::post('user/client/send', [UserClientController::class, 'send']);

    });

    Route::group(['middleware'=>["chief:api"]], function(){

        Route::post('chief/client/index', [ChiefController::class, 'index']);

    });


    Route::post('chief', [UserClientController::class, 'chief'])->middleware('chief:api');
    Route::post('director', [UserClientController::class, 'director'])->middleware('director:api');
    Route::post('accountant', [UserClientController::class, 'accountant'])->middleware('accountant:api');


    Route::post('product/create', [ProductController::class, 'store']);
    // Route::post('user/create', [UserController::class, 'create']);

});
