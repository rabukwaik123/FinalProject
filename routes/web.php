<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamMemberController;


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

    Route::resource('carts', CartController::class);
    Route::post('carts_update/{id}', [CartController::class, 'update'])->name('carts_update');
    Route::get('carts_trashed', [CartController::class, 'trashed'])->name('carts_trashed');
    Route::get('carts_restore/{id}', [CartController::class, 'restore'])->name('carts_restore');
    Route::get('carts_force/{id}', [CartController::class, 'force'])->name('carts_force');
    Route::get('carts_force', [CartController::class, 'forceAll'])->name('carts_forceAll');

    Route::resource('orders', OrderController::class);
    Route::post('orders_update/{id}',[OrderController::class ,'update'])->name('orders_update');


    Route::resource('team_members', TeamMemberController::class);
    Route::post('team_members_update/{id}', [TeamMemberController::class, 'update'])->name('team_members_update');
    Route::get('team_members_trashed', [TeamMemberController::class, 'trashed'])->name('team_members_trashed');
    Route::get('team_members_restore/{id}', [TeamMemberController::class, 'restore'])->name('team_members_restore');
    Route::get('team_members_force/{id}', [TeamMemberController::class, 'force'])->name('team_members_force');
    Route::get('team_members_forceAll', [TeamMemberController::class, 'forceAll'])->name('team_members_forceAll');

});
