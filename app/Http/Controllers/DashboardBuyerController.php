<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class DashboardBuyerController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Ambil pesanan aktif
        $activeOrders = Order::with(['orderItems.product'])
            ->where('buyer_id', $user->id)
            ->whereIn('status', ['pending', 'diproses'])
            ->latest()
            ->get();

        // Hitung total order items
        $totalActiveOrderItems = $activeOrders->sum(function ($order) {
            return $order->orderItems->count();
        });
        // Produk
        $query = Product::with(['user', 'category', 'reviews'])
            ->withCount('orderItems')
            ->where('is_available', true)
            ->orderByDesc('order_items_count');

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

        $products = $query->take(4)->get(); // maksimal 4 produk
        $categories = Category::all();

        if ($products->every(fn($product) => $product->order_items_count === 0)) {
            $products = Product::with(['user', 'category', 'reviews'])
                ->where('is_available', true)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('buyer.dashboard', compact('products', 'categories', 'activeOrders', 'totalActiveOrderItems'), ['title' => 'Home']);
    }
}
