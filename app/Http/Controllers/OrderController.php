<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['order_items.product'])
            ->where('buyer_id', Auth::id())
            ->orderBy('created_at', 'desc');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return view('buyer.pesanan.index', compact('orders'));
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


    public function destroy($id)
    {
        $order = Order::where('id', $id)
            ->where('buyer_id', auth()->id())
            ->firstOrFail();

        if ($order->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak bisa dibatalkan karena sudah diproses.');
        }

        $order->order_items()->delete(); // hapus item-nya dulu
        $order->delete(); // hapus pesanan

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
