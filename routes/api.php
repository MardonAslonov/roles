<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SendDocumentController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WareHouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware'=>["auth:api"]], function(){
    Route::group(['middleware'=>["admin:api"]], function(){
        Route::group(['prefix' => 'type'], function () {
            Route::post('create', [TypeController::class, 'create']);
            Route::get('delete', [TypeController::class, 'delete']);
            Route::get('show', [TypeController::class, 'show']);
            Route::post('update', [TypeController::class, 'update']);
            Route::get('list', [TypeController::class, 'list']);
        });
        Route::group(['prefix' => 'warehouse'], function () {
            Route::post('create', [WareHouseController::class, 'create']);
            Route::get('delete', [WareHouseController::class, 'delete']);
            Route::get('show', [WareHouseController::class, 'show']);
            Route::post('update', [WareHouseController::class, 'update']);
            Route::get('list', [WareHouseController::class, 'list']);
        });
        Route::group(['prefix' => 'user'], function () {
            Route::post('create', [UserController::class, 'create']);
            Route::get('delete', [UserController::class, 'delete']);
            Route::get('show', [UserController::class, 'show']);
            Route::post('update', [UserController::class, 'update']);
            Route::get('list', [UserController::class, 'list']);
        });
    });
    Route::group(['prefix' => 'document'], function () {
        Route::get('list', [SendDocumentController::class, 'list']);
        Route::post('create', [DocumentController::class, 'create'])->middleware('workman:api');
        Route::get('delete', [DocumentController::class, 'delete'])->middleware('workman:api');
        Route::get('show', [DocumentController::class, 'show'])->middleware('workman:api');
        Route::post('update', [DocumentController::class, 'update'])->middleware('workman:api');
        Route::get('abort/list', [SendDocumentController::class, 'abortList'])->middleware('workman:api');
        Route::get('send', [SendDocumentController::class, 'send'])->middleware('send:api');
        Route::get('unsend', [SendDocumentController::class, 'unsend'])->middleware('unsend:api');
    });
    Route::post('logout', [AuthController::class, 'logout']);
});
