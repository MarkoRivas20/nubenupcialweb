<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TemplateController;
use App\Http\Controllers\Admin\SectionController;
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
Route::get('orders',[OrderController::class,'index'])->name('orders.index');

Route::resource('invitations', InvitationController::class);
Route::resource('templates', TemplateController::class);
Route::put('templates/{template}/disabled', [TemplateController::class, 'disabled'])->name('templates.disabled');

Route::get('templates/{template}/sections/create', [SectionController::class, 'create'])->name('sections.create');
Route::post('templates/{template}/sections/store', [SectionController::class, 'store'])->name('sections.store');
Route::get('templates/{template}/sections/{section}/edit', [SectionController::class, 'edit'])->name('sections.edit')->scopeBindings();
Route::put('templates/{template}/sections/{section}/update', [SectionController::class, 'update'])->name('sections.update')->scopeBindings();
Route::delete('templates/{template}/sections/{section}/destroy',[SectionController::class, 'destroy'])->name('sections.destroy')->scopeBindings();

Route::get('invitations/{template}/create', [InvitationController::class, 'create'])->name('invitations.create');