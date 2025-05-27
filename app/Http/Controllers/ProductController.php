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
        $query = Product::with(['user', 'category'])
            ->withCount('orderItems') // hitung jumlah order item per product
            ->where('is_available', true)
            ->orderByDesc('order_items_count'); // urutkan dari yang paling sering dibeli

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_product', 'like', "%$search%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        $products = $query->get();
        $categories = Category::all();

        return view('buyer.daftarmenu.index', compact('products', 'categories'), ['title' => 'Daftar Menu']);
    }



    // Menampilkan detail produk
    public function show($id)
    {
        $product = Product::with('user', 'category')->findOrFail($id);
        $product = Product::with(['reviews.buyer', 'reviews.order'])->findOrFail($id);
        return view('buyer.daftarmenu.show', compact('product'), ['title' => 'Detail Menu']);
    }
}
