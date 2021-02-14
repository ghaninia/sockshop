@extends("dashboard.masters.layout")
@section("content")
<div class="tasks m-0">
    <div class="container">
        <div class="titr">
            <form action="{{ route('dashboard.orders.index') }}" dir="rtl" class="search">
                <input value="{{ request('s') }}" name="s" type="search" class="form-control" placeholder="فیلتر" />
                <button type="button" class="btn prepend">
                    <i class="feather-filter"></i>
                </button>
            </form>
        </div>
        <div class="list">
            @foreach($orders as $order)
            <div class="item">
                <div class="content">
                    <h5>{{ $order->fullname }}</h5>
                    <p class="small">{{ optional($order->product)->title }}</p>
                </div>
                <div class="meta">
                    <span class="order-md-2 small" dir="ltr">
                        {{ verta($order->created_at)->format("Y/m/d H:i") }}
                    </span>
                    <span class="order-md-2 small">
                        {{ orderStatus($order->status) }}
                    </span>
                    <span class="order-md-2 small">
                        {{ number_format($order->price) }}ریال
                    </span>
                </div>
                <div class="dropdown">
                    <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="feather-menu"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left">
                        <a href="{{ route('dashboard.orders.edit' , $order->id) }}" class="dropdown-item">جزئیات</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop
