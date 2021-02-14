<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Sms;
use Verta;

class WhenPaymentedListener
{

    public function __construct()
    {
    }

    public function handle($event)
    {
        $order = $event->order;
        $msg = trans("site.sms.admin", [
            "code" => $order->tracking_code,
            "fullname" => $order->fullname,
            "mobile" => $order->mobile,
            "product" => $order->product->title,
            "variance" => $order->variance->title,
            "address" => $order->address->address,
            "created" => verta($order->created_at)->format("Y/m/d H:i:s")
        ]);
        Sms::sendSMS([
            // $order->mobile,
            config("site.notification")
        ], $msg);
    }
}
