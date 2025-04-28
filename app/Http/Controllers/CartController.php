<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {

        $userId = 1;

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

        return view('buyer.keranjang', [
            'groupedCartItems' => $grouped,
            'total' => $total, // Kirimkan total ke view
        ]);
    }




    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = 1; // <<-- masih manual user_id sementara ya
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
}
