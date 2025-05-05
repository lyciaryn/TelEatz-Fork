<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // << otomatis pakai user yang login

        $cartItems = CartItem::with(['product.user']) // load product dan user (seller)
            ->whereHas('cart', function ($query) use ($userId) {
                $query->where('buyer_id', $userId);
            })
            ->get();

        // Hitung total harga
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->quantity * $cartItem->product->price;
        });

        // Group cartItems berdasarkan seller_id
        $grouped = $cartItems->groupBy(function ($item) {
            return $item->product->user->id ?? null;
        });

        return view('buyer.keranjang.index', [
            'groupedCartItems' => $grouped,
            'total' => $total,
            'title' => 'keranjang'
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id(); // << otomatis pakai user yang login
        $productId = $request->product_id;
        $quantity = $request->quantity;

        // Cari cart-nya user
        $cart = Cart::firstOrCreate(
            ['buyer_id' => $userId],
            ['buyer_id' => $userId]
        );

        // Cek apakah produk ini sudah ada di cart_item
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            // Kalau sudah ada, tambahkan quantity
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Kalau belum ada, buat baru
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke cart!');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            // Ambil item berdasarkan ID dan pastikan milik buyer yang login
            $item = CartItem::where('id', $id)
                ->whereHas('cart', function ($query) {
                    $query->where('buyer_id', auth()->id());
                })
                ->firstOrFail();

            // Update quantity
            $item->quantity = $request->quantity;
            $item->save();

            return redirect()->back()->with('justsuccess', 'Jumlah keranjang berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $item = CartItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
