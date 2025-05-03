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
        return view('buyer.daftarmenu.index', compact('products'), ['title' => 'Daftar Menu']);
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('user', 'category')->findOrFail($id);
        return view('buyer.daftarmenu.show', compact('product'), ['title' => 'Daftar Menu : Detail']);
    }
}
