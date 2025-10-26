<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Публічна частина сайту
|--------------------------------------------------------------------------
*/

// Головна сторінка та "Про нас"
Route::view('/', 'pages.home')->name('home');
Route::view('/about', 'pages.about')->name('about');

// Каталог тварин (тільки перегляд)
Route::resource('animals', AnimalController::class)->only(['index', 'show']);

// Кошик
// 🛒 Кошик
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{animal}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{animal}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/cart/ajax-update', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');


// Оформлення замовлення
Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::view('/thank-you', 'cart.thankyou')->name('thankyou');


/*
|--------------------------------------------------------------------------
| Авторизовані користувачі
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Профіль користувача
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Історія замовлень користувача
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.mine');
});
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('animals', App\Http\Controllers\Admin\AnimalAdminController::class);
});

/*
|--------------------------------------------------------------------------
| Адмін-панель
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {

        // Головна сторінка адмінки
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        // CRUD для тварин
        Route::resource('animals', AnimalController::class)->except(['index', 'show']);

        // Замовлення
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}', [AdminController::class, 'updateStatus'])->name('updateStatus');
    });
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->group(function () {
        Route::get('/check', function () {
            return '✅ Admin middleware працює!';
        });
    });

/*
|--------------------------------------------------------------------------
| Auth маршрути (Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
