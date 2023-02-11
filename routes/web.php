<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {     return view('welcome'); });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes..
]);
 
//Auth::routes();

Route::prefix('prospect')->group( function () {

    Route::get('/list', [App\Http\Controllers\ProspectController::class, 'index'])->name('prospect.list');
    Route::get('/register', [App\Http\Controllers\ProspectController::class, 'register'])->name('prospect.register');

    Route::get('/edit/{id}', [App\Http\Controllers\ProspectController::class, 'edit'])->name('prospect.edit');

    Route::post('/register', [App\Http\Controllers\ProspectController::class, 'store'])->name('prospect.register.store');
});


Route::prefix('product')->group( function () {

    Route::match(['get', 'post'],'/list', [App\Http\Controllers\ProductController::class, 'index'])->name('product.list');
    Route::match(['get', 'post'],'/grid', [App\Http\Controllers\ProductController::class, 'grid'])->name('product.grid');
    
    Route::get('/view/{id}', [App\Http\Controllers\ProductController::class, 'view'])->name('product.view');    

});

Route::prefix('quote')->group(function () {
    Route::match(['get', 'post'],'/list', [App\Http\Controllers\QuoteController::class, 'index'])->name('quote.list');

    
});

Route::prefix('cart')->group(function () {
    Route::get('/price/{type}', [App\Http\Controllers\CartController::class, 'set_price'])->name('cart.price');

    Route::post('/prospect', [App\Http\Controllers\CartController::class, 'set_prospect'])->name('cart.prospect');
    Route::get('/prospect/remove', [App\Http\Controllers\CartController::class, 'remove_prospect'])->name('cart.prospect.remove');

    Route::get('/get', [App\Http\Controllers\CartController::class, 'get'])->name('cart.get');    

    Route::get('/add/{product_id}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::get('/remove/{id}', [App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');

    Route::get('/update', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');

});

Route::prefix('ajax')->group(function () {
    Route::post('/prospect', [App\Http\Controllers\AjaxController::class, 'get_prospects'])->name('ajax.prospect');
} );