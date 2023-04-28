<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




/** This is where all the Public routes are written **/
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/product-details/{id}', [HomeController::class, 'show'])->name('product.details');


    Route::get('/shopping-cart', function () {
        return Inertia::render('Public/Cart', [
       // Data goes here......

        ]);
        })->name('shopping.cart');
});