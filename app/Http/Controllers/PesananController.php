<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = auth()->user()->receivedOrders()->with('orderItems.review')->get();
        return view('seller.Pesanan.historyPesanan_seller', compact('pesanan'));
    }

    public function indexPesanan()
    {
        $pesanan = auth()->user()->receivedOrders()
        ->whereIn('status', ['diproses', 'pending'])
        ->with('orderItems.product') // Eager load the product for each orderItem
        ->get();

        return view('seller.Pesanan.Pesanan_seller', compact('pesanan'));
    }

    public function show($id)
    {
        $pesanan = auth()->user()->orders()
        ->where('id', $id)
        ->with('orderItems.product') // Eager load the product for each orderItem
        ->firstOrFail();

        return view('buyer.Pesanan.Pesanan_detail', compact('pesanan'));
    }

    public function statusHandler(Request $request, $id)
    {
        $pesanan = auth()->user()->receivedOrders()->where('id', $id)->firstOrFail();

        if ($pesanan->status == 'pending') {
            $pesanan->status = 'diproses';
        } elseif ($pesanan->status == 'diproses') {
            $pesanan->status = 'selesai';

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
