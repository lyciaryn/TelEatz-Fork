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

        $user_id = 1;

        $cart = Cart::where('buyer_id', $user_id)->with('items.product')->first();
        return view('buyer.keranjang', compact('cart'));
    }
}
