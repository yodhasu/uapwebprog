<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;

use App\Http\Controllers\WalletController;

Route::get('/', function () {
    return redirect('/dashboard/home');
});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/9abbd9ab5899b62135377fd67806477c7739f25c', [AuthController::class, 'showAdminPage'])->name('admin');
Route::get('/9abbd9ab5899b62135377fd67806477c7739f25c/home', [ProductController::class, 'indexAdmin'])->name('admin.home');

// Route::get('/dashboard/home', function () {
//     return view('dashboard.home');
// })->middleware('auth')->name('home');

Route::get('/dashboard/home', [ProductController::class, 'index'])->middleware('auth')->name('home');

Route::get('/manage-product', function () {
    // Check if the session contains a valid token
    if (Session::get('admin_token') !== 'valid_admin_token') {
        return abort(403); // Deny access if the token is missing or invalid
    }

    return view('secret.manage-product');
})->name('manageproduct');

Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{product_id}', [ProductController::class, 'show'])->name('products.show'); // Show single product

Route::get('admin//products/{product_id}', [ProductController::class, 'show'])->name('admin.products.show'); // Show single product


// Cart Routes
Route::get('/cart/open', [CartController::class, 'index'])->name('cart.view');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');


Route::middleware('auth')->group(function () {
    Route::get('/wallet/{userId}', [WalletController::class, 'show'])->name('wallet.show');
    Route::get('/wallet/{userId}/top-up', [WalletController::class, 'topUpForm'])->name('wallet.topup');
    Route::post('/wallet/{userId}/top-up', [WalletController::class, 'topUp'])->name('wallet.topup.post');
});

Route::get('/cart/summary', [CartController::class, 'checkoutView'])->name('cartsum');

Route::post('/niggapaying', [CartController::class, 'checkout'])->name('niggacheckout');
Route::post('/pay/niggapaying', [CartController::class, 'checkout'])->name('paytheblackman');

// Route::get('/admin', function () {
//     return view('admin');
// })->middleware('check-referrer')->name('admin');

