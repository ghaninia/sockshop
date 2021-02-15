@extends("dashboard.masters.layout")
@section("content")
<div class="row">
    @if($orders->isNotEmpty())
    @foreach($orders as $order)
    <div class="col col-xs-12">
        <div class="detail">
            <h5>{{ orderStatus($order->status) }}</h5>
            <span>{{ number_format($order->count) }}</span>
        </div>
    </div>
    @endforeach
    @endif
    <div class="col col-xs-12">
        <div class="detail">
            <h5>فروش کل</h5>
            <span class="price">{{ number_format($sells) }}</span>
        </div>
    </div>
</div>
<div class="settings pt-5">
    <div class="item">
        <h5>نمودار فروش</h5>
        <small class='d-block' style='color:#bababa'>فروش یکماه پیش</small>
        <canvas class="chart-line" data-items='{{ $chart }}'></canvas>
    </div>
</div>
@stop
