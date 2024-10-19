<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'index'])->name('store.index');

Route::get('categories/{category}',[CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{product}',[ProductController::class,'show'])->name('products.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('checkout',[CheckoutController::class,'index'])->middleware('auth')->name('checkout.index');

Route::post('checkout/paid', [CheckoutController::class,'paid'])->name('checkout.paid');
Route::get('checkout/successful', function(){
    return view('checkout.successful');
})->name('checkout.successful');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


