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

    Route::get('/register', [App\Http\Controllers\ProspectController::class, 'register'])->name('quote.register');
});