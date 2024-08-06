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
//grouping of routes

Route::group(['prefix'=>'products'],function()
{
//products
Route::get('/category/{id}', [ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('/single-product/{id}', [ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('/shop', [ProductsController::class, 'shop'])->name('products.shop');

//CART
Route::post('/add-cart', [ProductsController::class, 'addToCart'])->name('products.add.cart');
Route::get('/cart', [ProductsController::class, 'cart'])->name('products.cart');
Route::get('/delete-cart/{id}', [ProductsController::class, 'deleteFromCart'])->name('products.cart.delete');

//checkout and paying
Route::post('/prepare-checkout', [ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout');
Route::get('/checkout', [ProductsController::class, 'checkout'])->name('products.checkout');
Route::post('/checkout', [ProductsController::class, 'processcheckout'])->name('products.process.checkout');
Route::get('/pay', [ProductsController::class, 'pay'])->name('products.pay');
   
});
 


Route::group(['prefix'=>'users'],function(){
//users pages
Route::get('/my-orders', [UsersController::class, 'myOrders'])->name('users.orders');
Route::get('/settings', [UsersController::class, 'settings'])->name('users.settings');
Route::post('/settings/{id}', [UsersController::class, 'updateUserSettings'])->name('users.settings.update');
});