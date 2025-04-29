<?php

use App\Http\Controllers\KelolaMakananController;
use App\Http\Controllers\MakananController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('login');
});


Route::get('/login', function () {
    return view('login');
});


Route::get('/dashboard', function () {
    return view('buyer.dashboard');
});


Route::get('/daftarmenu', [ProductController::class, 'index'])->name('buyer.daftarmenu');
Route::get('/daftarmenudetail/{id}', [ProductController::class, 'show'])->name('buyer.daftarmenudetail');


Route::get('/keranjang', [CartController::class, 'index'])->name('buyer.keranjang');
Route::post('/keranjang/store', [CartController::class, 'store'])->name('keranjang.store');


Route::get('/pesanan', function () {
    return view('buyer.pesanan');
});


Route::get('/historipesanan', function () {
    return view('buyer.historipesanan');
});


Route::get('/profil', function () {
    return view('buyer.profil');
});


#Rayhan (SIDEBAR)
Route::get('/dashboardseller', function () {
    return view('seller.KelolaMakanan.dashboard_seller');
});

Route::get('/kelolamenuseller', function () {
    return view('seller.profil_seller');
});

Route::get('/pesananseller', function () {
    return view('seller.pesanan_seller');
});

Route::get('/historiseller', function () {
    return view('seller.histori_seller');
}) -> name('seller.historiseller');

Route::get('/ulasanseller', function () {
    return view('seller.ulasan_seller');
});

Route::get('/logoutseller', function () {
    return view('seller.profil_seller');
});

Route::get('/kelolamakanan', function () {
    return view('seller.KelolaMakanan.KelolaMakanan_seller');
});


Route::get('/kelolamakanan', [KelolaMakananController::class, 'index'])->name('kelolamakanan');
Route::get('/kelolamakanan/create', [KelolaMakananController::class, 'fetchcategory'])->name('kelolamakanan.create');


Route::get('/kelolamakanan/{id}/edit', [KelolaMakananController::class, 'edit'])->name('kelolamakanan.edit');
Route::put('/kelolamakanan/{id}', [KelolaMakananController::class, 'update'])->name('kelolamakanan.update');


route::get('/kelolamakanan/{id}/showdetail', [KelolaMakananController::class, 'showingdetail'])->name('kelolamakanan.showdetail');
Route::post('/kelolamakanan', [KelolaMakananController::class, 'store'])->name('kelolamakanan.store');

route::delete('/kelolamakanan/{id}', [KelolaMakananController::class, 'delete'])->name('kelolamakanan.softdelete');