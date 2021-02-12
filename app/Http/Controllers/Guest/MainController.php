<?php

namespace App\Http\Controllers\Guest;

use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SearchStore;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    use Response;

    public function index()
    {
        $this->seo([]);

        return view('guest.main');
    }

    public function store(Request $request)
    {
    }

    public function search(SearchStore $request)
    {
        $mobile = $request->input("mobile");
        $trackingCode = $request->input("tracking_code");
        $order = Order::where([
            "mobile" => $mobile,
            "tracking_code" => $trackingCode
        ])->first();

        if (is_null($order))
            return $this->fail("هیچ تراکنشی ثبت نشده است !");

        return $this->success([
            "content" => view("guest.order.search", compact("order"))->render()
        ]);
    }
}
