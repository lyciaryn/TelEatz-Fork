<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // menampilkan semua produk
    public function index(Request $request)
    {
        $query = Product::with('user', 'category')
            ->where('is_available', true); // hanya yang tersedia

        // Filter search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_product', 'like', "%$search%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        // Filter kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        $products = $query->get();
        $categories = Category::all(); // ambil semua kategori dari DB

        return view('buyer.daftarmenu.index', compact('products', 'categories'));
    }



    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('user', 'category')->findOrFail($id);
        $product = Product::with(['reviews.buyer', 'reviews.order'])->findOrFail($id);
        return view('buyer.daftarmenu.show', compact('product'), ['title' => 'Daftar Menu : Detail']);
    }
}
