<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->name('cms.')->group(function(){
    Route::view('/','cms.temp')->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::post('categories_update/{id}',[CategoryController::class ,'update'])->name('categories_update');
    Route::resource('brands', BrandController::class);
    Route::post('brands_update/{id}',[BrandController::class ,'update'])->name('brands_update');
    Route::resource('products', ProductController::class);
    Route::post('products_update/{id}',[ProductController::class ,'update'])->name('products_update');

});
