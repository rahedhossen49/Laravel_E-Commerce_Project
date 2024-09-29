<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;

Auth::routes();


Route::middleware('auth')->group(function(){

  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('/categories/{id?}',[CategoryController::class,'index'])->name('category.index');
  Route::post('/categories/store',[CategoryController::class,'store'])->name('category.store');
  Route::get('/categories/destroy/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
  Route::patch('/categories/update/{id}',[CategoryController::class,'update'])->name('category.update');



  // * Products Routes

  Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
  });

});
