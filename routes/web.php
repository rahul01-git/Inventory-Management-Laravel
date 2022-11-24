<?php

use Illuminate\Support\Facades\Auth;
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

Route::resource('/',App\Http\Controllers\ShowController::class,['names'=>'show']);

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/supplier', App\Http\Controllers\SupplierController::class,['names' => 'supplier']);
    Route::resource('/customer', App\Http\Controllers\CustomerController::class,['names' => 'customer'])->only('index','create','edit');
    Route::resource('/category', App\Http\Controllers\CategoryController::class,['names' => 'category']);
    Route::resource('/product', App\Http\Controllers\ProductController::class,['names' => 'product']);
    Route::resource('/unit', App\Http\Controllers\UnitController::class,['names' => 'unit']);
    Route::resource('/purchase', App\Http\Controllers\PurchaseController::class,['names' => 'purchase']);
    Route::get('/category/product/{id}',[App\Http\Controllers\PurchaseController::class,'getProduct'])->name('product.get');
    Route::resource('/invoice', App\Http\Controllers\InvoiceController::class,['names' => 'invoice']);
    Route::get('/reports/{type}',[App\Http\Controllers\HomeController::class, 'report'])->name('report');
});




