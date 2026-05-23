<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/car/{car}', [App\Http\Controllers\HomeController::class, 'showCar'])->name('car.show');
Route::post('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');

Auth::routes();

// User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/book/{car}', [App\Http\Controllers\User\BookingController::class, 'store'])->name('book.store');
    Route::get('/booking/{booking}', [App\Http\Controllers\User\BookingController::class, 'show'])->name('book.show');
    Route::post('/payment/{booking}', [App\Http\Controllers\User\PaymentController::class, 'upload'])->name('payment.upload');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('car-types', App\Http\Controllers\Admin\CarTypeController::class);
    Route::resource('cars', App\Http\Controllers\Admin\CarController::class);
    Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class)->except(['create', 'store', 'destroy']);
    Route::resource('payments', App\Http\Controllers\Admin\PaymentController::class)->only(['index', 'show', 'update']);
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show']);
    Route::resource('contacts', App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
});
