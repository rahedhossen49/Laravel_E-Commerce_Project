<?php

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\ProfileController;

// * customer login register route

Route::get('/sign-in',[CustomerLoginController::class,'showLoginForm'])->name('customer.login');
Route::post('/sign-in/authenticate',[CustomerLoginController::class,'login'])->name('customer.login.auth');
Route::get('/sign-up',[CustomerRegisterController::class,'showRegistrationForm'])->name('customer.register');
Route::post('/sign-up',[CustomerRegisterController::class,'register'])->name('customer.register.confirm');
Route::get('/sign-out',[CustomerLoginController::class,'logout'])->name('customer.signOut');

// * Profile routes
Route::middleware('auth:customer')->group(function() {
    Route::get('/my-profile',[ProfileController::class,'myProfile'])->name('profile.show');
});



Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/category/{slug}',[CategoryController::class,'archiveProducts'])->name('frontend.category.show');
Route::get('/product/{slug}',[ProductController::class,'showProduct'])->name('frontend.show');
Route::get('/search/product',[ProductController::class,'ajaxSearch'])->name('frontend.product.search');
