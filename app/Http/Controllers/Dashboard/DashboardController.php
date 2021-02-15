<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $this->seo([
            "title" => "داشبورد مدیریتی"
        ]);

        $date = Carbon::parse('-1 month');
        $chart = Order::select([
            DB::raw('DATE(created_at) as x'),
            DB::raw('COUNT(*) AS y')
        ])
            ->whereStatus(Order::STATUS_SUCCEED)
            ->whereDate('created_at', '>=', $date)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();
        $chart = $chart->map(function ($item) {
            return [
                "x" => verta($item->x)->format("Y/m/d"),
                "y" => $item->y
            ];
        });

        $orders = Order::select([
            DB::raw("COUNT(*) as count"),
            "status"
        ])
            ->groupBy("status")
            ->get();
        $sells = Order::whereStatus(Order::STATUS_SUCCEED)->sum("price");
        return view("dashboard.main", compact('chart', 'orders' ,'sells'));
    }
}
