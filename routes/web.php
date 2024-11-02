<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/products', [ProductController::class,'index'])->name('products.index');
Route::get('/products/shop', [ProductController::class,'shop'])->name('products.shop');
Route::get('/products/about', [ProductController::class,'about'])->name('products.about');
Route::get('/products/services', [ProductController::class,'services'])->name('products.services');
Route::get('/products/blog', [ProductController::class,'blog'])->name('products.blog');
Route::get('/products/contact', [ProductController::class,'contact'])->name('products.contact');
Route::get('/products/cart', [ProductController::class,'cart'])->name('products.cart');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
