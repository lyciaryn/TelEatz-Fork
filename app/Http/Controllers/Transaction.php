<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class Transaction extends Controller
{
    
    public function index()
    {
        $transaction = Order::all();
        return view('admin.transaksi.allTransaction', compact('transaction'));
    }

}