<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


// les routes d'autentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


//route principale, pour les categories et les produits
Route::middleware('auth')->group(function () {

    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/products', ProductController::class);
});


// les routes profiles
Route::middleware('auth')->group(function () {

    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profiles.update');
});
