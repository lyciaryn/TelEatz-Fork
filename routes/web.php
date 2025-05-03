<?php

use App\Http\Controllers\KelolaMakananController;
use App\Http\Controllers\MakananController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardBuyerController;
use App\Http\Controllers\DashboardSellerController;


// LOGIN
Route::get('/', function () {
    return view('landing');
});

Route::get('/landing', function () {
    return view('landing');
});



Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
// LOGIN



Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardBuyerController::class, 'index'])->name('buyer.dashboard');
    // Daftar Menu
    Route::get('/daftarmenu', [ProductController::class, 'index'])->name('buyer.daftarmenu.index');
    Route::get('/daftarmenudetail/{id}', [ProductController::class, 'show'])->name('buyer.daftarmenu.show');
    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('buyer.keranjang.index');
    Route::post('/keranjang/store', [CartController::class, 'store'])->name('buyer.keranjang.store');
});



Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardSellerController::class, 'index'])->name('seller.dashboard');


    Route::get('/kelolamakanan', [KelolaMakananController::class, 'index'])->name('kelolamakanan');
    Route::get('/kelolamakanan/create', [KelolaMakananController::class, 'fetchcategory'])->name('kelolamakanan.create');


    Route::get('/kelolamakanan/{id}/edit', [KelolaMakananController::class, 'edit'])->name('kelolamakanan.edit');
    Route::put('/kelolamakanan/{id}', [KelolaMakananController::class, 'update'])->name('kelolamakanan.update');


    route::get('/kelolamakanan/{id}/showdetail', [KelolaMakananController::class, 'showingdetail'])->name('kelolamakanan.showdetail');
    Route::post('/kelolamakanan', [KelolaMakananController::class, 'store'])->name('kelolamakanan.store');

    route::delete('/kelolamakanan/{id}', [KelolaMakananController::class, 'delete'])->name('kelolamakanan.softdelete');
});




// Route::get('/kelolamenuseller', function () {
//     return view('seller.profil_seller');
// });

// Route::get('/pesananseller', function () {
//     return view('seller.pesanan_seller');
// });

// Route::get('/historiseller', function () {
//     return view('seller.histori_seller');
// })->name('seller.historiseller');

// Route::get('/ulasanseller', function () {
//     return view('seller.ulasan_seller');
// });

// Route::get('/logoutseller', function () {
//     return view('seller.profil_seller');
// });

// Route::get('/kelolamakanan', function () {
//     return view('seller.KelolaMakanan.KelolaMakanan_seller');
// });
