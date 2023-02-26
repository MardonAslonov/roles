<?php

use App\Http\Controllers\AccountantController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChiefController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WareHouseController;
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


Route::get('user/create', [UserController::class, 'create']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware'=>["auth:api"]], function(){
    Route::group(['prefix' => 'type'], function () {
        Route::post('create', [TypeController::class, 'create']);
        Route::get('delete', [TypeController::class, 'delete']);
        Route::get('show', [TypeController::class, 'show']);
        Route::post('update', [TypeController::class, 'update']);
    });
    Route::group(['prefix' => 'warehouse'], function () {
        Route::post('create', [WareHouseController::class, 'create']);
        Route::get('delete', [WareHouseController::class, 'delete']);
        Route::get('show', [WareHouseController::class, 'show']);
        Route::post('update', [WareHouseController::class, 'update']);
    });



    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('user/create', [UserController::class, 'create']);
    Route::post('user/delete', [UserController::class, 'delete']);
    Route::post('user/index', [UserController::class, 'index']);
    Route::get('user/show', [UserController::class, 'show']);
    Route::post('user/update', [UserController::class, 'update']);

    Route::post('document/create', [DocumentController::class, 'add']);

    Route::group(['middleware'=>["workman:api"]], function(){

        Route::post('user/client/create', [UserClientController::class, 'store']);
        Route::get('user/client/show', [UserClientController::class, 'show']);
        Route::get('user/client/index', [UserClientController::class, 'index']);
        Route::get('user/client/delete', [UserClientController::class, 'destroy']);
        Route::post('user/client/update', [UserClientController::class, 'update']);
        Route::post('user/client/send', [UserClientController::class, 'send']);

    });

    Route::group(['middleware'=>["chief:api"]], function(){

        Route::post('chief/client/index', [ChiefController::class, 'index']);
        Route::post('chief/client/abort', [ChiefController::class, 'abort']);
        Route::post('chief/client/send', [ChiefController::class, 'send']);

    });

    Route::group(['middleware'=>["director:api"]], function(){

        Route::post('director/client/index', [DirectorController::class, 'index']);
        Route::post('director/client/abort', [DirectorController::class, 'abort']);
        Route::post('director/client/send', [DirectorController::class, 'send']);

    });

    Route::group(['middleware'=>["accountant:api"]], function(){

        Route::post('accountant/client/index', [AccountantController::class, 'index']);
        Route::post('accountant/client/abort', [AccountantController::class, 'abort']);
        Route::post('accountant/client/send', [AccountantController::class, 'send']);

    });

});
