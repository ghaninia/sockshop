<?php

namespace App\Http\Controllers\Guest;

use App\Events\WhenPaymentedEvent;
use App\Helpers\Traits\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStore;
use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class OrderController extends Controller
{
    use Response;
    protected $invoice;

    public function store(Product $product, OrderStore $request)
    {
        try {
            $variance = $product->variances()->whereId($request->input("variance"))->first();
            if (!$variance)
                throw new Exception("واریانس با محصول مطابقت ندارد .");

            $price = intval( $variance->price );

            $address = Address::create([
                "address" => $request->input("address"),
            ]);

            $order = Order::create([
                "fullname" => $request->input("fullname"),
                "mobile" => $request->input("mobile"),
                "variance_id" => $request->input("variance"),
                "price" => $price,
                "address_id" => $address->id,
                "product_id" => $product->id
            ]);

            $invoice = new Invoice;
            // درگاه شاپرک به تومان میباشد
            $invoice->amount($price / 10 );
            $invoice->detail($product->title);

            $url = route("guest.order.factor");
            return Payment::callbackUrl($url)->purchase($invoice, function ($driver, $transactionId) use ($order) {
                $order->update([
                    "transaction_id" => $transactionId,
                ]);
            })->pay()->render();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function factor(Request $request)
    {
        $this->seo([
            "title" => "فاکتور"
        ]) ;
        $validate = Validator::make($request->all(), [
            "Authority" => ["required", "numeric"],
            "Status" => ["required", "in:OK,NOK"]
        ]);
        if ($validate->failed())
            return redirect()->route("guest.main");

        $transactionId = $request->input("Authority");
        $status = $request->input("Status");
        $order = Order::with("address")->whereTransactionId($transactionId)->first();

        try {
            if (is_null($order))
                throw new Exception("هیچ تراکنشی یافت نشده است", 404);

            // درگاه بانکی شاپرک به تومان میباشد
            $price = intval($order->price) / 10;
            $receipt = Payment::amount($price)->transactionId($transactionId)->verify();
            $trackingCode = uniqid();
            $order->update([
                "reference_id" => $receipt->getReferenceId(),
                'tracking_code' => $trackingCode,
                "status" => Order::STATUS_SUCCEED,
            ]);
            event(new WhenPaymentedEvent($order));
            return view("guest.order.factor", [
                "information" => [
                    "title" => "فاکتور"
                ] ,
                "status" => true,
                "order" => $order ,
                "msg" => "تراکنش با موفقیت ثبت گردیده است .",
                "tracking_code" => $trackingCode,
            ]);
        } catch (Exception $e) {
            $code = $e->getCode();
            if ($code === -22) {
                $order->where("status", "<>", Order::STATUS_SUCCEED)->update([
                    "status" => Order::STATUS_FAILED
                ]);
            }
            return view("guest.order.factor", [
                "information" => [
                    "title" => "فاکتور"
                ] ,
                "order" => $order ,
                "status" => false,
                "code" => $code ,
                "msg" => $e->getMessage()
            ]);
        }
    }
}
