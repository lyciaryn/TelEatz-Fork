<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{

    public function index()
    {
        $totalPenjualan = Order::where('status', 'selesai')->count();
        $totalSeller = User::where('role', 'seller')->count(); // sesuaikan dengan sistem rolenya
        $totalBuyer = User::where('role', 'buyer')->count(); // sesuaikan dengan sistem rolenya
        $transaksiAktif = Order::where('status', 'diproses')->orWhere('status', 'dibatalkan')->count();

        return view('admin.dashboard', compact('totalPenjualan', 'totalBuyer', 'totalSeller', 'transaksiAktif'));
    }
}
