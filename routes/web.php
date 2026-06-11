<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OrderController::class, 'index'])->name('home');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->middleware('throttle:10,1');

Route::get('/orders', [OrderController::class, 'list'])->name('orders.list')->middleware('auth');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('throttle:5,1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
