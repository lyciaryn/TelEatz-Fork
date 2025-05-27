<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    public function exportPDF($id)
    {
        $order = Order::with(['order_items.product', 'buyer'])->findOrFail($id);

        $pdf = Pdf::loadView('seller.pesanan.pdf', compact('order'));

        return $pdf->download('pesanan-'.$order->id.'.pdf');
    }
}


