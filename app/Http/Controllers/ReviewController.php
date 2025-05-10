<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ReviewController extends Controller
{
    
    public function index()
    {
        $makanan = Product::where('seller_id', auth::id())->get();
        return view('seller.Review.review', compact('makanan'));
    }
    public function showReview($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        return view('seller.Review.reviewDetail', compact('product'));
    }
}
