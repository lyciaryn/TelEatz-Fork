<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // menampilkan semua produk
    public function index()
    {
        $products = Product::with('user', 'category')->get();
        return view('buyer.daftarmenu', compact('products'));
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('user', 'category')->findOrFail($id);
        return view('buyer.daftarmenudetail', compact('product'));
    } 
}
