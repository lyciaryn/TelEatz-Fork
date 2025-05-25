<?php

namespace App\Http\Controllers;
use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardSellerController extends Controller
{
    public function index()
    {
        $data = $this->getDashboardData();
        return view('seller.dashboard', $data);
    }
    private function getDashboardData()
    {
        $makanan = Product::where('seller_id', auth::id())->count();
        $orderIds = Order::where('seller_id', auth()->id())->pluck('id');
        $now = now()->format('H:i:s');

        $isOpen = User::where('id', auth()->id())
            ->whereTime('open_time', '<=', $now)
            ->whereTime('close_time', '>=', $now)
            ->exists();

        $status = $isOpen ? 'Sedang Buka' : 'Sedang Tutup';

        $order = OrderItem::whereIn('order_id', $orderIds)->sum('quantity');
        $totalReviews = Review::whereIn('order_id', $orderIds)->count();
        $avgReviews = Review::whereIn('order_id', $orderIds)->avg('rating');


                $sellerId = auth()->id();

            // Per minggu
            $weeklyIncome = Order::selectRaw('YEAR(created_at) as year, WEEK(created_at) as week, SUM(total_price) as total')
                ->where('seller_id', $sellerId)
                ->groupBy(DB::raw('YEAR(created_at), WEEK(created_at)'))
                ->orderByRaw('YEAR(created_at), WEEK(created_at)')
                ->get();

            // Per bulan
            $monthlyIncome = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_price) as total')
                ->where('seller_id', $sellerId)
                ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                ->orderByRaw('YEAR(created_at), MONTH(created_at)')
                ->get();

            // Per bulan
            $dailyIncome = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, DAY(created_at) as day, SUM(total_price) as total')
                ->where('seller_id', $sellerId)
                ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at), DAY(created_at)'))
                ->orderByRaw('YEAR(created_at), MONTH(created_at), DAY(created_at)')
                ->get();

            // Siapkan array untuk grafik mingguan
            $dailyLabels = [];
            $dailyData = [];
            foreach ($dailyIncome as $item) {
                $dailyLabels[] = "{$item->day} - {$item->month} - {$item->year}";
                $dailyData[] = $item->total;
            }

            // Siapkan array untuk grafik mingguan
            $weeklyLabels = [];
            $weeklyData = [];
            foreach ($weeklyIncome as $item) {
                $weeklyLabels[] = "{$item->week} - {$item->year}";
                $weeklyData[] = $item->total;
            }

            // Siapkan array untuk grafik bulanan
            $monthlyLabels = [];
            $monthlyData = [];
            foreach ($monthlyIncome as $item) {
                $monthlyLabels[] = "{$item->month}-{$item->year}";
                $monthlyData[] = $item->total;
            }

        return [
            'makanan' => $makanan,
            'order' => $order,
            'totalReviews' => $totalReviews,
            'status' => $status,
            'avgReviews' => $avgReviews,
            'weeklyLabels' => $weeklyLabels,
            'weeklyData' => $weeklyData,
            'monthlyLabels' => $monthlyLabels,
            'monthlyData' => $monthlyData,
            'dailyLabels' => $dailyLabels,
            'dailyData' => $dailyData
        ];
    }

    public function changeStatus(Request $request)
    {
        $user = User::find(auth()->id());

        if ($request->action == 'buka') {
            $user->is_open = 1;
            $message = 'Toko berhasil dibuka';
            $status = 'Sedang Buka';

        } elseif ($request->action == 'tutup') {
            $user->is_open = 0;
            $message = 'Toko berhasil ditutup';
            $status = 'Sedang Tutup';
        }
        $user->save();
        $data = $this->getDashboardData();

        return view('seller.dashboard', ['status' => $status], $data);
    }
}
