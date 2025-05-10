<?php

// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Order $order, Product $product)
    {
        return view('buyer.review.create', compact('order', 'product'));
    }

    public function store(Request $request, Order $order, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'buyer_id'   => auth()->id(),
            'order_id'   => $order->id,
            'product_id' => $product->id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        return redirect()->route('buyer.pesanan.index')->with('success', 'Ulasan berhasil dikirim!');
    }

    public function destroy($id)
    {
        $review = Review::where('id', $id)->where('buyer_id', auth()->id())->firstOrFail();
        $review->delete();

        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
