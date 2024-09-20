<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Admin\DashboardController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::middleware('auth')->group(function(){

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});
