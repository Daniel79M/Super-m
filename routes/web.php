<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;



// les routes d'autentification
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

//claude
//route principale, pour les categories et les produits
Route::middleware('auth')->group(function () {

    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/products', ProductController::class);

    Route::resource( '/sales', SaleController::class);
});


// les routes profiles
Route::middleware('auth')->group(function () {

    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profiles.update');
});
//====

//Damaz
// Route pour afficher le formulaire de réinitialisation du mot de passe
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');

// Route pour traiter la demande de réinitialisation du mot de passe
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');


// route des ventes

// Route::get('/sales', function (){
//     return view('sales.index');
// });


// Route::resource('/categories', CategoryController::class);
// Route::resource('/products', ProductController::class);

// statistique Damaz
Route::get('/DamSalesChart/Salechart', [StatisticalController::class, 'monthlySalesChart'])->name('sales.statistics');
Route::get('/invoices/index', [InvoiceController::class, 'index']);


// Route::get('/sales/statistics', [StatisticalController::class, 'monthlySalesChart'])->name('sales.statistics');