<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DashboardController;

Route::get('/', fn () => view('welcome'))->name('home');

// Blog: пропускає тільки з ?gate=one
Route::middleware('gate:1')->group(function () {
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/about', [BlogController::class, 'about'])->name('blog.about');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
});

// Shop: тільки з ?gate=two
Route::middleware('gate:2')->group(function () {
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop/cart', [ShopController::class, 'cart'])->name('shop.cart');
    Route::get('/shop/product/{sku}', [ShopController::class, 'product'])->name('shop.product');
});

// Dashboard: тільки з ?gate=three
Route::middleware('gate:3')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
});
