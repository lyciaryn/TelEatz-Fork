<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});



Route::get('/dashboard', function () {
    return view('buyer.dashboard');
});



Route::get('/daftarmenu', function () {
    return view('buyer.daftarmenu');
});


Route::get('/pesanan', function () {
    return view('buyer.pesanan');
});


Route::get('/keranjang', function () {
    return view('buyer.keranjang');
});


Route::get('/historipesanan', function () {
    return view('buyer.historipesanan');
});


Route::get('/profil', function () {
    return view('buyer.profil');
});
