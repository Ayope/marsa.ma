<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::get('register', 'registration')->name('register');
    // ->middleware('NowLogin');
    Route::post('registration-user', 'registerUser')->name('registration.user');

    Route::get('login', 'login')->name('login');
    // ->middleware('NowLogin');
    Route::post('login-user', 'loginUser')->name('login.user');

    Route::post('logout', 'logout')->name('logout');

});

Route::controller(ProductController::class)->group(function(){
    Route::get('products', 'index')->name('products');
    Route::get('store', 'E_store')->name('store');
    Route::get('show/{title}', 'show')->name('show');

    Route::get('productCreate', 'create')->name('productCreate');
    Route::post('product', 'store')->name('create.product');

    Route::get('productEdit/{id}', 'edit')->name('productEdit');
    // should be corrected maybe to get instead of post (products.edit and delete)
    Route::post('product/{id}', 'update')->name('products.edit');

    Route::post('delete/{id}', 'destroy')->name('product.destroy');

    Route::post('search', 'search')->name('search');
});

Route::controller(CommandController::class)->group(function(){
    Route::post('addToCart', 'addToCart')->name('addToCart');
    Route::get('showCart/{user_id}', 'showCart')->name('showCart');
    Route::post('deleteFromCart', 'deleteProductFromCart')->name('deleteFromCart');
    Route::post('updateQuantityPrice', 'updateQuantityPrice')->name('updateQuantityPrice');
    Route::get('checkout/{id}', 'checkout')->name('checkout');
});

// Route::controller(UserController::class)->group(function(){
//     Route::get('profile', 'profile')->name('profile');
//     Route::post('profile', 'editProfile')->name('profile');
// });
