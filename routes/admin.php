<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::get('/options', [OptionController::class, 'index'])->name('options.index');

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])->name('products.variants')->scopeBindings();
Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])->name('products.variantsUpdate')->scopeBindings();

Route::resource('covers', CoverController::class);
Route::resource('invitations', InvitationController::class);
