<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\SslCommerzPaymentController;

// * customer login register route

Route::get('/sign-in',[CustomerLoginController::class,'showLoginForm'])->name('customer.login');
Route::post('/sign-in/authenticate',[CustomerLoginController::class,'login'])->name('customer.login.auth');
Route::get('/sign-up',[CustomerRegisterController::class,'showRegistrationForm'])->name('customer.register');
Route::post('/sign-up',[CustomerRegisterController::class,'register'])->name('customer.register.confirm');
Route::get('/sign-out',[CustomerLoginController::class,'logout'])->name('customer.signOut');

// * Profile routes
Route::middleware('auth:customer')->group(function() {
    Route::get('/my-profile',[ProfileController::class,'myProfile'])->name('profile.show')->middleware('customer');
});



Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/category/{slug}',[CategoryController::class,'archiveProducts'])->name('frontend.category.show');
Route::get('/product/{slug}',[ProductController::class,'showProduct'])->name('frontend.show');
Route::get('/search/product',[ProductController::class,'ajaxSearch'])->name('frontend.product.search');
Route::post('/add-to-cart',[CartController::class,'store'])->name('cart.store');

// // SSLCOMMERZ Start

// Route::get('/checkout',[SslCommerzPaymentController::class,'checkout'])->name('checkout');

// Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->middleware('customer');
// Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

// Route::post('/success', [SslCommerzPaymentController::class, 'success']);
// Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
// Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

// Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
// //SSLCOMMERZ END
// SSLCOMMERZ Start

Route::get('/checkout',[SslCommerzPaymentController::class,'checkout'])->name('checkout');
Route::post('/pay', [SslCommerzPaymentController::class, 'index'])->middleware('customer');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::get('/success', [SslCommerzPaymentController::class, 'success'])->name('success');
Route::get('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::get('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
// SSLCOMMERZ END
