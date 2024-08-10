<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Products\ProductsController;

// Route::get('/home', function () {
//     return view('welcome');
// });

Auth::routes();  

Route::get('/home', [HomeController::class, 'index'])->name('home'); // (URL , ARRAY) 
 Route::get('/', [HomeController::class, 'index'])->name('home');                                                                      // ARRAY- CONTROLLER,FUNCTIONNAME  
 Route::get('/about', [HomeController::class, 'about'])->name('about');                                                            //NAME OF THE ROUTE - HELPS IN REDIRECTION TO ROUTE
 Route::get('/contact', [HomeController::class, 'contact'])->name('contact'); 

 //grouping of routes

Route::group(['prefix'=>'products'],function()
{
//products
Route::get('/category/{id}', [ProductsController::class, 'singleCategory'])->name('single.category');
Route::get('/single-product/{id}', [ProductsController::class, 'singleProduct'])->name('single.product');
Route::get('/shop', [ProductsController::class, 'shop'])->name('products.shop');

//CART
Route::post('/add-cart', [ProductsController::class, 'addToCart'])->name('products.add.cart')->middleware('auth');
Route::get('/cart', [ProductsController::class, 'cart'])->name('products.cart')->middleware('auth');
Route::get('/delete-cart/{id}', [ProductsController::class, 'deleteFromCart'])->name('products.cart.delete')->middleware('auth');

//checkout and paying
Route::post('/prepare-checkout', [ProductsController::class, 'prepareCheckout'])->name('products.prepare.checkout')->middleware('auth');
Route::get('/checkout', [ProductsController::class, 'checkout'])->name('products.checkout')->middleware('auth');
Route::post('/checkout', [ProductsController::class, 'processcheckout'])->name('products.process.checkout')->middleware('auth');
Route::get('/pay', [ProductsController::class, 'pay'])->name('products.pay')->middleware('auth');
   
});
 


Route::group(['prefix'=>'users'],function(){
//users pages
Route::get('/my-orders', [UsersController::class, 'myOrders'])->name('users.orders')->middleware('auth');
Route::get('/settings', [UsersController::class, 'settings'])->name('users.settings')->middleware('auth');
Route::post('/settings/{id}', [UsersController::class, 'updateUserSettings'])->name('users.settings.update')->middleware('auth');
});



//admin panel
Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login');
Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');


Route::group(['prefix'=>'admins','middleware'=>'auth:admin'],function(){

//admins
Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');
Route::get('/all-admins', [AdminsController::class, 'displayAdmins'])->name('admins.all');
Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');

//categories
Route::get('/all-categories', [AdminsController::class, 'displayCategories'])->name('categories.all');



});
// Route for logging out
 Route::post('logout', [AdminsController::class, 'logout'])->name('logout');
