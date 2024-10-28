<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigurationController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->middleware('can:access dashboard')->name('dashboard');

Route::resource('categories', CategoryController::class)->middleware('can:manage categories');
Route::resource('products', ProductController::class)->middleware('can:manage products');

Route::get('/options', [OptionController::class, 'index'])->middleware('can:manage options')->name('options.index');

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])->middleware('can:manage products')->name('products.variants')->scopeBindings();
Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])->middleware('can:manage products')->name('products.variantsUpdate')->scopeBindings();

Route::resource('covers', CoverController::class)->middleware('can:manage covers');
Route::get('orders',[OrderController::class,'index'])->middleware('can:manage orders')->name('orders.index');

Route::get('users',[UserController::class,'index'])->middleware('can:manage users')->name('users.index');
Route::get('users/{user}/edit',[UserController::class,'edit'])->middleware('can:manage users')->name('users.edit');
Route::put('users/{user}/update',[UserController::class,'update'])->middleware('can:manage users')->name('users.update');

Route::get('configurations/{configuration}/edit', [ConfigurationController::class, 'edit'])->middleware('can:manage configurations')->name('configurations.edit');

Route::resource('coupons', CouponController::class)->middleware('can:manage coupons');

Route::resource('invitations', InvitationController::class)->middleware('can:manage invitations');
Route::resource('templates', TemplateController::class)->middleware('can:manage templates');
Route::put('templates/{template}/disabled', [TemplateController::class, 'disabled'])->middleware('can:manage templates')->name('templates.disabled');

Route::get('templates/{template}/sections/create', [SectionController::class, 'create'])->middleware('can:manage templates')->name('sections.create');
Route::post('templates/{template}/sections/store', [SectionController::class, 'store'])->middleware('can:manage templates')->name('sections.store');
Route::get('templates/{template}/sections/{section}/edit', [SectionController::class, 'edit'])->middleware('can:manage templates')->name('sections.edit')->scopeBindings();
Route::put('templates/{template}/sections/{section}/update', [SectionController::class, 'update'])->middleware('can:manage templates')->name('sections.update')->scopeBindings();
Route::delete('templates/{template}/sections/{section}/destroy',[SectionController::class, 'destroy'])->middleware('can:manage templates')->name('sections.destroy')->scopeBindings();

Route::get('invitations/{template}/create', [InvitationController::class, 'create'])->middleware('can:manage invitations')->name('invitations.create');