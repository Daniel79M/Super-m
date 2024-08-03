<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticalController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\ReportController;

// les routes d'autentification

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


//route principale, pour les categories et les produits
Route::middleware('auth')->group(function () {

    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::resource('/categories', CategoryController::class);

    Route::resource('/products', ProductController::class);

    Route::resource('/sales', SaleController::class);
});


// les routes profiles
Route::middleware('auth')->group(function () {

    Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profiles.update');
});

// Route pour afficher le formulaire de réinitialisation du mot de passe
Route::get('/password/reset', [PasswordResetController::class, 'showResetForm'])->name('password.request');

// Route pour traiter la demande de réinitialisation du mot de passe
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

//factures et bilan
Route::middleware('auth')->group(function () {

    Route::get('/invoices/{sale_id}/pdf', [InvoiceController::class, 'generatePDF'])->name('invoices.pdf');

    Route::get('/invoices/{sale_id}', [InvoiceController::class, 'show'])->name('invoices.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::post('/reports', [ReportController::class, 'generateReport'])->name('reports.generate');
});


// statistique Damaz
Route::get('/DamSalesChart/Salechart', [StatisticalController::class, 'monthlySalesChart'])->name('sales.statistics');





Route::get('/password/email', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('otp.emailForm');
Route::post('/password/email', [ForgotPasswordController::class, 'sendOtp'])->name('otp.sendOtp');
Route::get('/password/verify-otp', [ForgotPasswordController::class, 'showOtpForm'])->name('otp.verifyOtpForm');
Route::post('/password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('otp.verifyOtp');