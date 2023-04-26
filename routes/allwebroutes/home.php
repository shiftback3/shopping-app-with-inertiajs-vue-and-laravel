<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




/** This is where all the Public routes are written **/

Route::get('/', function () {
return Inertia::render('Public/Index', [

]);
})->name('home');

Route::get('/product-details', function () {
    return Inertia::render('Public/ProductDetails', [
    'name' => 'Ogbu Garuba',
    ]);
    })->name('product.details');


    Route::get('/shopping-cart', function () {
        return Inertia::render('Public/Cart', [
        'name' => 'Ogbu Garuba',
        ]);
        })->name('shopping.cart');