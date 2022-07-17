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
    Route::apiResource('states', \App\Http\Controllers\Settings\StateController::class);
    Route::apiResource('brands', \App\Http\Controllers\Settings\BrandController::class);
    Route::apiResource('categories', \App\Http\Controllers\Settings\CategoryController::class);
    Route::apiResource('types', \App\Http\Controllers\Settings\TypeController::class);
    Route::apiResource('returns', \App\Http\Controllers\Settings\ReturnController::class);
    Route::apiResource('interventions', \App\Http\Controllers\Settings\InterventionController::class);
    Route::apiResource('depots', \App\Http\Controllers\Settings\DepotController::class);

    Route::get('customers/lite', [\App\Http\Controllers\CustomerController::class, 'lite']);
    Route::apiResource('customers', \App\Http\Controllers\CustomerController::class);

    Route::post('items/{item}/archive', [\App\Http\Controllers\ItemController::class, 'archive'])->name('items.archive');
    Route::post('items/{item}/unarchive', [\App\Http\Controllers\ItemController::class, 'unarchive'])->name('items.unarchive');
    Route::apiResource('items', \App\Http\Controllers\ItemController::class);

    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update']);
    Route::put('profile/password-update', [\App\Http\Controllers\ProfileController::class, 'passwordUpdate']);
    Route::get('profile/avatar', [\App\Http\Controllers\ProfileController::class, 'getAvatar']);
    Route::post('profile/avatar', [\App\Http\Controllers\ProfileController::class, 'uploadAvatar']);
    Route::delete('profile/avatar', [\App\Http\Controllers\ProfileController::class, 'removeAvatar']);
});
