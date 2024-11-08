<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', [StoreController::class, 'index'])->name('store.index');

Route::get('categories/{category}',[CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{product}',[ProductController::class,'show'])->name('products.show');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('checkout/{coupon?}',[CheckoutController::class,'index'])->middleware('auth')->name('checkout.index');

Route::post('checkout/paid', [CheckoutController::class,'paid'])->name('checkout.paid');
Route::post('checkout/buy/{coupon?}', [CheckoutController::class,'buy'])->middleware('auth')->name('checkout.buy');

Route::get('checkout/pay/successful', function(){
    return view('checkout.successful');
})->name('checkout.successful');

Route::get('orders',[OrderController::class,'index'])->middleware('auth')->middleware('can:manage orders users')->name('orders.index');
Route::get('orders/{order}',[OrderController::class,'show'])->middleware('auth')->middleware('can:manage orders users')->name('orders.show');

Route::get('invitations',[InvitationController::class,'index'])->middleware('auth')->name('invitations.index');
Route::get('invitations/{invitation}',[InvitationController::class,'show'])->name('invitations.show');
Route::get('invitations/{invitation}/confirmations',[InvitationController::class,'confirmations'])->middleware('auth')->name('invitations.confirmations');
Route::get('invitations/{invitation}/download',[InvitationController::class,'download'])->middleware('auth')->name('invitations.download');
Route::get('invitations/{invitation}/export',[InvitationController::class,'export'])->middleware('auth')->name('invitations.export');

Route::get('404', function(){
    return view('404');
})->name('notfound');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


