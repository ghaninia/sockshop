@extends("guest.layouts.master")
@section("main")
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="mt-5 mb-5 alert {{ $status ? 'alert-success' : 'alert-danger' }}">
                {{ $msg }}
            </div>
            @if( !! $order )
            <ul class="factor">
                <li>
                    <span>نام محصول</span>
                    <span>{{ optional($order->product)->title }}</span>
                </li>
                <li>
                    <span>ویژگی محصول</span>
                    <span>{{ optional($order->variance)->title }}</span>
                </li>
                <li>
                    <span>قیمت</span>
                    <span>{{ number_format($order->price) }} ریال</span>
                </li>
                <li>
                    <span>نام خریدار</span>
                    <span>{{ $order->fullname }}</span>
                </li>
                <li>
                    <span>شماره تماس</span>
                    <span>{{ $order->mobile }}</span>
                </li>
                <li>
                    <span>آدرس</span>
                    <span>{{ optional($order->address)->address }}</span>
                </li>
                @if( $order->status === \App\Models\Order::STATUS_SUCCEED )
                <li>
                    <span>کدرهگیری</span>
                    <span>{{ $order->tracking_code }}</span>
                </li>
                @endif
            </ul>
            @endif
        </div>
    </div>
</div>
@stop
