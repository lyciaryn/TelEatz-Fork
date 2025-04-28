<?php

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



Route::get('/pesanan', function () {
    return view('buyer.pesanan');
});



Route::get('/historipesanan', function () {
    return view('buyer.historipesanan');
});


Route::get('/profil', function () {
    return view('buyer.profil');
});
