<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderUpdate;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use Response ;
    public function index(Request $request)
    {
        $this->seo([
            "title" => "لیست سفارشات"
        ]);
        $s = $request->input("s");
        $orders = Order::where(function ($query) use ($s) {
            return $query->orwhere("tracking_code", $s)
                ->orwhere("mobile", "like", "%{$s}%")
                ->orwhere("fullname", "like", "%{$s}%")
                ->orwhereHas("product", function ($query) use ($s) {
                    return $query->where('products.title', "like", "%{$s}%");
                });
        })
            ->orderBy("created_at", "DESC")
            ->paginate(12);
        return view("dashboard.order.index", compact("orders"));
    }

    public function edit(Order $order)
    {
        $this->seo([
            "title" => "جزئیات سفارش"
        ]);
        return view("dashboard.order.show", compact("order"));
    }

    public function update(Order $order, OrderUpdate $request)
    {
        $date = $this->jalaliToDatetime( $request->input('post_trackinged_at') ) ;
        $order->update([
            "post_tracking_code" => $request->input("post_tracking_code") ,
            "post_trackinged_at" => $date ,
        ]) ;

        return $this->success("جزئیات سفارش با موفقیت ویرایش گردید.") ;
    }
}
