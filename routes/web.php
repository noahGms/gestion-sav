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

Route::get('/{any}', [\App\Http\Controllers\SpaController::class, 'index'])->where('any', '.*')->name('landing');;

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginView'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.handle');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {
    //Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'passwordUpdate'])->name('profile.password.update');

    Route::group(['middleware' => 'is_admin'], function () {
        Route::resource('/settings/states', \App\Http\Controllers\Settings\StateController::class)->except(['show', 'create']);
        Route::resource('/settings/users', \App\Http\Controllers\Settings\UserController::class)->except(['show', 'create']);
        Route::get('/settings/users/{user}/toggle-admin', [\App\Http\Controllers\Settings\UserController::class, 'toggleAdmin'])->name('users.toggle-admin');
        Route::resource('/settings/brands', \App\Http\Controllers\Settings\BrandController::class)->except(['show', 'create']);
        Route::resource('/settings/categories', \App\Http\Controllers\Settings\CategoryController::class)->except(['show', 'create']);
        Route::resource('/settings/types', \App\Http\Controllers\Settings\TypeController::class)->except(['show', 'create']);
        Route::resource('/settings/returns', \App\Http\Controllers\Settings\ReturnController::class)->except(['show', 'create']);
        Route::resource('/settings/interventions', \App\Http\Controllers\Settings\InterventionController::class)->except(['show', 'create']);
        Route::resource('/settings/depots', \App\Http\Controllers\Settings\DepotController::class)->except(['show', 'create']);
    });

    Route::resource('/customers', \App\Http\Controllers\CustomerController::class);
    Route::post('/items/{item}/archive', [\App\Http\Controllers\ItemController::class, 'archive'])->name('items.archive');
    Route::post('/items/{item}/unarchive', [\App\Http\Controllers\ItemController::class, 'unarchive'])->name('items.unarchive');
    Route::post('/items/{item}/users', [\App\Http\Controllers\ItemUserController::class, 'store'])->name('items.users.store');
    Route::delete('/items/{item}/users/{user}', [\App\Http\Controllers\ItemUserController::class, 'destroy'])->name('items.users.destroy');
    Route::post('/items/{item}/parts', [\App\Http\Controllers\PartController::class, 'store'])->name('items.parts.store');
    Route::delete('/items/{item}/parts/{part}', [\App\Http\Controllers\PartController::class, 'destroy'])->name('items.parts.destroy');
    Route::post('/items/{item}/files', [\App\Http\Controllers\ItemFileController::class, 'store'])->name('items.files.store');
    Route::delete('/items/{item}/files/{file}', [\App\Http\Controllers\ItemFileController::class, 'destroy'])->name('items.files.destroy');
    Route::resource('/items', \App\Http\Controllers\ItemController::class);
});

