<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\KelolaMakananController;
use App\Http\Controllers\MakananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\Transaction;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardBuyerController;
use App\Http\Controllers\DashboardSellerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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


Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');




Route::middleware(['auth', 'role:buyer'])->prefix('buyer')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardBuyerController::class, 'index'])->name('buyer.dashboard');

    // Daftar Menu
    Route::get('/daftarmenu', [ProductController::class, 'index'])->name('buyer.daftarmenu.index');
    Route::get('/daftarmenudetail/{id}', [ProductController::class, 'show'])->name('buyer.daftarmenu.show');
    // Keranjang
    Route::get('/keranjang', [CartController::class, 'index'])->name('buyer.keranjang.index');
    Route::post('/keranjang/store', [CartController::class, 'store'])->name('buyer.keranjang.store');
    Route::put('/keranjang/update/{id}', [CartController::class, 'update'])->name('buyer.keranjang.update');
    Route::delete('/keranjang/remove/{id}', [CartController::class, 'destroy'])->name('buyer.keranjang.destroy');

    // Pesanan
    Route::get('/pesanan', [OrderController::class, 'index'])->name('buyer.pesanan.index');
    Route::post('/pesanan/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/pesanan/batalkan/{id}', [OrderController::class, 'cancelOrder'])->name('buyer.pesanan.cancelOrder');
    Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('buyer.pesanan.destroy');
    // Faktur
    Route::get('/pesanan/{order}/faktur', [OrderController::class, 'showFaktur'])->name('buyer.pesanan.faktur');
    Route::get('/pesanan/{order}/faktur/download', [OrderController::class, 'downloadFaktur'])->name('buyer.pesanan.downloadFaktur');

    // Tampilkan form ulasan
    Route::get('/ulasan/{order}/{product}', [ReviewController::class, 'create'])->name('buyer.review.create');

    // Simpan ulasan
    Route::post('/ulasan/{order}/{product}', [ReviewController::class, 'store'])->name('buyer.review.store');
    Route::delete('/ulasan/{id}', [ReviewController::class, 'destroy'])->name('buyer.review.destroy');
});



Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardSellerController::class, 'index'])->name('seller.dashboard');

    //Kelola Makanan
    Route::get('/kelolamakanan', [KelolaMakananController::class, 'index'])->name('kelolamakanan');
    Route::get('/kelolamakanan/create', [KelolaMakananController::class, 'fetchcategory'])->name('kelolamakanan.create');
    Route::get('/kelolamakanan/{id}/edit', [KelolaMakananController::class, 'edit'])->name('kelolamakanan.edit');
    Route::put('/kelolamakanan/{id}', [KelolaMakananController::class, 'update'])->name('kelolamakanan.update');
    route::get('/kelolamakanan/{id}/showdetail', [KelolaMakananController::class, 'showingdetail'])->name('kelolamakanan.showdetail');
    Route::post('/kelolamakanan', [KelolaMakananController::class, 'store'])->name('kelolamakanan.store');
    route::delete('/kelolamakanan/{id}', [KelolaMakananController::class, 'delete'])->name('kelolamakanan.softdelete');

    // Pesanan & History
    Route::get('/pesanan', [PesananController::class, 'indexPesanan'])->name('seller.pesanan');
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('seller.pesanan.show');
    Route::put('/pesanan/{id}/status', [PesananController::class, 'statusHandler'])->name('seller.pesanan.status');
    Route::get('/history', [PesananController::class, 'index'])->name('seller.pesanan.history');

    // Review
    Route::get('/review', [ReviewController::class, 'index'])->name('seller.review');
    Route::get('/review/{id}', [ReviewController::class, 'showReview'])->name('seller.review.show');

    // Profile
    Route::get('/profilseller', [ProfileController::class, 'index'])->name('seller.profile');
    Route::put('/profilseller/{id}', [ProfileController::class, 'update'])->name('seller.profile.update');
    Route::get('/profilseller/gantiPassword', [ProfileController::class, 'changePasswordIndex'])->name('seller.profile.changePassword');
    Route::put('/seller/profile/{id}', [ProfileController::class, 'changePassword'])->name('seller.profile.update');

});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Transaksi
    Route::get('/transaksi', [Transaction::class, 'index'])->name('admin.transaction');
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
