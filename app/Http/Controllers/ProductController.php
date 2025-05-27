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
            ->withCount('orderItems') // jumlah order item
            ->withAvg('reviews', 'rating') // hitung rata-rata rating
            ->where('is_available', true);

        // Search by nama product atau nama user
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_product', 'like', "%$search%")
                    ->orWhereHas('user', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        // Filter by kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('nama_kategori', $request->category);
            });
        }

        // Filter by urutan / sorting
        // Filter by urutan / sorting
        if ($request->filled('sort') && $request->sort == 'rating') {
            $query->orderByDesc('reviews_avg_rating'); // rating tertinggi
        } else {
            $query->orderByDesc('order_items_count'); // default: terbanyak dibeli
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
