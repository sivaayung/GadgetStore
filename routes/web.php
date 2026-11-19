<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

//Route::get('/dashboard', function () {
    //return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

Route::resource('products', ProductController::class)
    ->only(['index']);

    Route::resource('categories', CategoryController::class)
    ->only(['index']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth', 'admin')->group(function () {
Route::resource('products', ProductController::class)->except(['index']);
Route::resource('categories', CategoryController::class)->except(['index']);

});