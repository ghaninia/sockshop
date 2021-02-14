@extends("dashboard.masters.layout")
@section("content")
<div class="settings">
    <div class="item">
        <ul class="factor">
            <li>
                <span>وضعیت</span>
                <span>{{ orderStatus($order->status) }}</span>
            </li>
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
    </div>
    @if( $order->status === \App\Models\Order::STATUS_SUCCEED )
    <form action="{{ route('dashboard.orders.update' , $order->id ) }}" class="form item mt-5" method="post">
        @csrf
        @method('put')
        <div class="form-row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="post_tracking_code">کد رهگیری پست</label>
                    <input value="{{ $order->post_tracking_code }}" name="post_tracking_code" class="form-control">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="post_trackinged_at">تاریخ رهگیری پست</label>
                    <input readonly @if(!!$order->post_trackinged_at) value="{{ verta($order->post_trackinged_at)->format('Y/m/d') }}" @endif class="form-control date" name="post_trackinged_at">
                </div>
            </div>
            <button class="btn primary">ویرایش</button>
        </div>
    </form>
    @endif
</div>
@stop
