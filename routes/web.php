<?php

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

Route::get('/se-connecter', [\App\Http\Controllers\AuthController::class, 'loginView'])->name('login');
Route::post('/se-connecter', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.handle');
Route::get('/se-deconnecter', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::resource('/settings/states', \App\Http\Controllers\Settings\StateController::class)->except(['show', 'create']);
    Route::resource('/settings/users', \App\Http\Controllers\Settings\UserController::class)->except(['show', 'create']);
    Route::resource('/settings/brands', \App\Http\Controllers\Settings\BrandController::class)->except(['show', 'create']);
    Route::resource('/settings/categories', \App\Http\Controllers\Settings\CategoryController::class)->except(['show', 'create']);
});

