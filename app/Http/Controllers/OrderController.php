<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $statusFilter = $request->query('status');

        $orders = Order::with(['order_items.product'])
            ->where('buyer_id', $userId)
            ->when($statusFilter, function ($query) use ($statusFilter) {
                $query->where('status', $statusFilter);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung jumlah per status
        $statusCounts = [
            'all' => Order::where('buyer_id', $userId)->count(),
            'pending' => Order::where('buyer_id', $userId)->where('status', 'pending')->count(),
            'diproses' => Order::where('buyer_id', $userId)->where('status', 'diproses')->count(),
            'selesai' => Order::where('buyer_id', $userId)->where('status', 'selesai')->count(),
            'dibatalkan' => Order::where('buyer_id', $userId)->where('status', 'dibatalkan')->count(),
        ];

        return view('buyer.pesanan.index', compact('orders', 'statusCounts'));
    }




    public function checkout(Request $request)
    {
        $request->validate([
            'dine_option' => 'required|in:dine-in,takeaway',
            'payment' => 'required|in:qris,cash',
        ]);

        $user = Auth::user();
        $cart = Cart::where('buyer_id', $user->id)->with('cart_items')->first();

        if (!$cart || $cart->cart_items->isEmpty()) {
            return back()->with('error', 'Cart kosong.');
        }

        // Group by seller_id dari produk
        $grouped = $cart->cart_items->groupBy(function ($item) {
            // Ambil langsung dari DB agar pasti ada
            return Product::find($item->product_id)->seller_id;
        });

        foreach ($grouped as $sellerId => $items) {
            $totalHarga = 0;

            $maxEstimate = $items->max(function ($item) {
                return $item->product->estimate ?? 0;
            });

            $order = Order::create([
                'buyer_id' => $user->id,
                'seller_id' => $sellerId,
                'total_price' => $totalHarga,
                'status' => 'pending',
                'dine_option' => $request->dine_option,
                'payment' => $request->payment,
                'estimated_ready_at' => now()->addMinutes($maxEstimate), // pakai timestamp
            ]);


            foreach ($items as $item) {
                $product = Product::find($item->product_id);

                if (!$product) continue;

                $harga = $product->harga;
                $subtotal = $harga * $item->quantity;
                $totalHarga += $subtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $harga, // satuan
                    'notes' => $item->notes
                ]); 
            }

            // update total_price setelah loop
            $order->update(['total_price' => $totalHarga]);
        }

        // Hapus cart dan item-nya
        $cart->cart_items()->delete();
        $cart->delete();

        return redirect()->route('buyer.pesanan.index')->with('success', 'Pesanan berhasil dibuat!');
    }

    public function cancelOrder($id)
    {
        $order = Order::where('id', $id)
            ->where('buyer_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $order->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
    }





    public function showFaktur(Order $order)
    {
        $order->load('order_items.product');

        return view('buyer.pesanan.faktur', compact('order'));
    }

    public function downloadFaktur(Order $order)
    {
        $order->load('order_items.product');

        $pdf = Pdf::loadView('buyer.pesanan.faktur', compact('order'));
        return $pdf->download($order->buyer->name . '-faktur-pesanan-' . $order->id . '.pdf');
    }




    public function destroy($id)
    {
        $order = Order::where('id', $id)
            ->where('buyer_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak bisa dihapu');
        }

        $order->order_items()->delete();
        $order->delete();

        return back()->with('success', 'Data Pesanan Berhasil dihapus.');
    }
}
