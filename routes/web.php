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
