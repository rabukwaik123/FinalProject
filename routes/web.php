<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cms/admin')->name('cms.')->group(function(){
    Route::view('/','cms.temp')->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::post('categories_update/{id}',[CategoryController::class ,'update'])->name('categories_update');
    Route::get('categories_trashed',[CategoryController::class ,'trashed'])->name('categories_trashed');
    Route::get('categories_restore/{id}',[CategoryController::class ,'restore'])->name('categories_restore');
    Route::get('force',[CategoryController::class ,'forceAll'])->name('categories_forceAll');
    Route::resource('brands', BrandController::class);
    Route::post('brands_update/{id}',[BrandController::class ,'update'])->name('brands_update');
    Route::resource('products', ProductController::class);
    Route::post('products_update/{id}',[ProductController::class ,'update'])->name('products_update');
    Route::resource('customers', CustomerController::class);
    Route::post('customers_update/{id}', [CustomerController::class, 'update'])->name('customers_update');
    Route::get('customers_trashed', [CustomerController::class, 'trashed'])->name('customers_trashed');
    Route::get('customers_restore/{id}', [CustomerController::class, 'restore'])->name('customers_restore');
    Route::get('customers_force', [CustomerController::class, 'forceAll'])->name('customers_forceAll');


});
