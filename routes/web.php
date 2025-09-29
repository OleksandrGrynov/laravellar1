<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{LabController, HomeController, PostController};

// ЛР1
Route::middleware(['web','query.mode'])->group(function () {
    Route::get('/lab',        [LabController::class, 'index'])->name('lab.index');
    Route::get('/lab/about',  [LabController::class, 'about'])->name('lab.about');
    Route::get('/lab/status', [LabController::class, 'status'])->name('lab.status');
    Route::get('/lab/echo',   [LabController::class, 'echo'])->name('lab.echo');
});

// ЛР3
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/about',   [HomeController::class, 'about'])->name('about');
Route::get('/posts',   [PostController::class, 'index'])->name('posts.index');
