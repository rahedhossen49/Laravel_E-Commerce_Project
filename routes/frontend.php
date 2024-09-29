<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;


Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/category/{slug}',[CategoryController::class,'archiveProducts'])->name('frontend.category.show');