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

        // Produk: hanya hitung order items yang status order-nya 'diproses'
        $query = Product::with(['user', 'category', 'reviews'])
            ->withCount([
                'orderItems as order_items_count' => function ($query) {
                    $query->whereHas('order', function ($q) {
                        $q->whereIn('status', ['diproses', 'selesai']);
                    });
                }
            ])
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

        $categories = Category::all();

        $products = $query->take(4)->get(); // maksimal 4 produk

        $query = Product::with(['user', 'category', 'reviews'])
            ->withCount([
                'orderItems as order_items_count' => function ($query) {
                    $query->whereHas('order', function ($q) {
                        $q->whereIn('status', ['diproses', 'selesai']);
                    });
                }
            ])
            ->where('is_available', true)
            ->whereHas('user', function ($q) {
                $q->where('is_open', true); // Hanya toko yang sedang buka
            })
            ->orderByDesc('order_items_count');


        return view('buyer.dashboard', compact('products', 'categories', 'activeOrders', 'totalActiveOrderItems'), ['title' => 'Home']);
    }
}
