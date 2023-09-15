<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(["namespace" => "App\Http\Controllers\User", "prefix" => "users"], function (){
    Route::post('/', 'StoreController');
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

    Route::group(['middleware' => 'jwt.auth'], function () {

        Route::group(["namespace" => "App\Http\Controllers\Post", "prefix" => "posts"], function (){
            Route::get('/', 'IndexController');
            Route::get('/create', 'CreateController');
            Route::post('/', 'StoreController');
            Route::patch('/{post}', 'UpdateController');
            Route::delete('/{post}', 'DestroyController');
        });

        Route::group(["namespace" => "App\Http\Controllers\User", "prefix" => "users"], function (){
            Route::get('/', 'IndexController');
            Route::patch('/{user}', 'UpdateController');
            Route::delete('/{user}', 'DestroyController');
        });

    });

});
