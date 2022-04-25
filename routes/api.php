<?php

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('whoami', [\App\Http\Controllers\AuthController::class, 'whoami']);
        Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    });
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('users/{user}/toggle-admin', [\App\Http\Controllers\Settings\UserController::class, 'toggleAdmin']);
    Route::apiResource('users', \App\Http\Controllers\Settings\UserController::class);
});
