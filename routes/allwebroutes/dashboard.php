<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




/** This is where all the Public routes are written **/
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category Route
    Route::get('/dashboard/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/dashboard/category/add', [CategoryController::class, 'show'])->name('category.add');
    Route::get('/dashboard/category/edit/{id?}', [CategoryController::class, 'show'])->name('category.edit');
    Route::post('/dashboard/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/dashboard/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/dashboard/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Product Route
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/dashboard/product/add', [ProductController::class, 'show'])->name('product.add');
    Route::get('/dashboard/product/edit/{id?}', [ProductController::class, 'show'])->name('product.edit');
    Route::post('/dashboard/product', [ProductController::class, 'store'])->name('product.store');
    Route::post('/dashboard/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/dashboard/product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});