<?php

use Illuminate\Support\Facades\Route;
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

    Route::get('productCreate', 'create')->name('productCreate');
    Route::post('product', 'store')->name('create.product');

    Route::get('productEdit/{id}', 'edit')->name('productEdit');
    Route::post('product/{id}', 'update')->name('products.edit');

    Route::post('delete/{id}', 'destroy')->name('product.destroy');

    Route::post('search', 'search')->name('search');
});
// Route::controller(UserController::class)->group(function(){
//     Route::get('profile', 'profile')->name('profile');
//     Route::post('profile', 'editProfile')->name('profile');
// });
