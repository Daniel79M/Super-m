<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasswordResetController;



// Route::get('/', [MainController::class, 'home'])->middleware('auth')->name('home');

// Route::resource('/categories', CategoryController::class)->middleware('auth');
// Route::resource('/products', ProductController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
});


Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login',[AuthController::class, 'login'])->name('auth.login');

Route::delete('/logout',[AuthController::class, 'logout'])->name('auth.logout');



// Route pour afficher le formulaire de réinitialisation du mot de passe
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');

// Route pour traiter la demande de réinitialisation du mot de passe
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');



