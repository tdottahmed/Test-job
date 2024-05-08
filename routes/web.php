<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/unit', UnitController::class);
Route::resource('/size', SizeController::class);
Route::resource('/color', ColorController::class);
Route::resource('/product', ProductController::class);
Route::get('pos-create', [SaleController::class,'create'])->name('pos.create');
Route::post('pos-store', [SaleController::class,'store'])->name('pos.store');
Route::get('single/product/{id}', [SaleController::class, 'singleProduct']);
Route::get('pos-list',[SaleController::class,'index'])->name('pos.index');
Route::get('/search/product', [ProductController::class, 'search']);
Route::get('pos/invoice/{id}', [SaleController::class, 'invoice'])->name('pos.invoice');
