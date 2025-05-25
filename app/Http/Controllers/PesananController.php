<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $pesanan = auth()->user()
            ->receivedOrders()
            ->with([
                'orderItems.review',
                'orderItems.product', // <- ini menambahkan eager load product
            ]);


        // Get all status for filter
        $allStatus = Order::where('seller_id', auth()->id())->pluck('status')->unique()->values();
        $allDineOptions = Order::where('seller_id', auth()->id())->pluck('dine_option')->unique()->values();
        $allPayment = Order::where('seller_id', auth()->id())->pluck('payment')->unique()->values();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $pesanan->where(function ($q) use ($search) {
                $q->whereHas('orderItems.product', function ($q1) use ($search) {
                    $q1->where('nama_product', 'like', "%$search%");
                });
            });
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $pesanan->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $pesanan->where('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $pesanan->where('created_at', '<=', $request->end_date);
        }
 
        // Filter status
        if ($request->filled('status')) {
            $pesanan->where('status', $request->status);
        }

        if ($request->filled('dine_option')) {
            $pesanan->where('dine_option', $request->dine_option);
        }

        if ($request->filled('payment')) {
            $pesanan->where('payment', $request->payment);
        }

        $sortOrder = $request->input('ordering', 'asc'); // default: terbaru
        if ($request->filled('ordering'))
        {
            $pesanan = $pesanan->orderBy('created_at', $sortOrder);
        }

        $pesanan = $pesanan->get();
        return view('seller.Pesanan.historyPesanan_seller', compact('pesanan', 'allStatus', 'allDineOptions', 'allPayment'));
    }

    public function indexPesanan(Request $request)
    {
        $pesanan = auth()->user()->receivedOrders()
        ->whereIn('status', ['diproses', 'pending'])
        ->with('orderItems.product');

        // Get all status for filter
        $allStatus = Order::where('seller_id', auth()->id())->pluck('status')->unique()->values();
        $allDineOptions = Order::where('seller_id', auth()->id())->pluck('dine_option')->unique()->values();
        $allPayment = Order::where('seller_id', auth()->id())->pluck('payment')->unique()->values();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $pesanan->where(function ($q) use ($search) {
                $q->whereHas('orderItems.product', function ($q1) use ($search) {
                    $q1->where('nama_product', 'like', "%$search%");
                });
            });
        }

        $pesanan->whereIn('status', ['diproses', 'pending'])
        ->with('orderItems.product');
        
        // Filter status
        if ($request->filled('status')) {
            $pesanan->where('status', $request->status);
        }

        if ($request->filled('dine_option')) {
            $pesanan->where('dine_option', $request->dine_option);
        }

        if ($request->filled('payment')) {
            $pesanan->where('payment', $request->payment);
        }

        $sortOrder = $request->input('ordering', 'asc'); // default: terbaru
        if ($request->filled('ordering'))
        {
            $pesanan = $pesanan->orderBy('created_at', $sortOrder);
        }

        $pesanan = $pesanan->get();

        return view('seller.Pesanan.Pesanan_seller', compact('pesanan', 'allStatus', 'allDineOptions', 'allPayment'));
    }

    public function show($id)
    {
        $pesanan = auth()->user()->orders()
        ->where('id', $id)
        ->with('orderItems.product')
        ->firstOrFail();

        return view('buyer.Pesanan.Pesanan_detail', compact('pesanan'));
    }

    public function statusHandler(Request $request, $id)
    {
        $pesanan = auth()->user()->receivedOrders()->where('id', $id)->firstOrFail();

        if ($request->input('action') == 'lanjut'){
            if ($pesanan->status == 'pending') {
                $pesanan->status = 'diproses';
            } elseif ($pesanan->status == 'diproses') {
                $pesanan->status = 'selesai';
            }
        }

        if ($request->input('action') == 'batal'){
            $pesanan->status = 'dibatalkan';

        }
        
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function showOrderWithReviews($id)
    {
        // Ambil order berdasarkan ID dan eager-load orderItems beserta review untuk setiap item
        $order = Order::with('orderItems.review')->where('id', $id)->firstOrFail();

        return view('seller.Pesanan.Pesanan_seller', compact('order'));
    }

    
}
