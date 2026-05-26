<?php

use App\Http\Controllers\CourierController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CourierController::class, 'index'])->name('home');

Route::resource('couriers', CourierController::class);
