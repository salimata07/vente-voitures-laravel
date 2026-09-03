<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    $latestCars = \App\Models\Car::latest()->take(6)->get();
    return view('welcome', compact('latestCars'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('cars', CarController::class);
Route::get('/admin/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
Route::post('/cars/{car}/buy', [App\Http\Controllers\OrderController::class, 'store'])
    ->middleware('auth')
    ->name('orders.store');

Route::get('/orders/{order}/invoice', [App\Http\Controllers\OrderController::class, 'invoice'])
    ->middleware('auth')
    ->name('orders.invoice');
Route::delete('/cars/{car}/images/{image}', [App\Http\Controllers\CarController::class, 'destroyImage'])
    ->middleware('auth')
    ->name('cars.images.destroy');
