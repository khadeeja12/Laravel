<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Products\ProductsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home'); // (URL , ARRAY) 
                                                                      // ARRAY- CONTROLLER,FUNCTIONNAME  
                                                                      //NAME OF THE ROUTE - HELPS IN REDIRECTION TO ROUTE
//products
Route::get('products/category/{id}', [ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('products/single-product/{id}', [ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('products/shop', [ProductsController::class, 'shop'])->name('products.shop');

//CART
Route::post('products/add-cart', [ProductsController::class, 'addToCart'])->name('products.add.cart');
Route::get('products/cart', [ProductsController::class, 'cart'])->name('products.cart');
Route::get('products/delete-cart/{id}', [ProductsController::class, 'deleteFromCart'])->name('products.cart.delete');

//checkout and paying
Route::post('products/prepare-checkout', [ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout');
Route::get('products/checkout', [ProductsController::class, 'checkout'])->name('products.checkout');
Route::post('products/checkout', [ProductsController::class, 'processcheckout'])->name('products.process.checkout');
Route::get('products/pay', [ProductsController::class, 'pay'])->name('products.pay');

//users pages
Route::get('users/my-orders', [UsersController::class, 'myOrders'])->name('users.orders');