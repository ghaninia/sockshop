<ul>
    <li>
        <span>سفارش دهنده</span>
        <span>{{ $order->fullname }}</span>
    </li>
    <li>
        <span>نام محصول</span>
        <span>{{ optional($order->product)->title }}</span>
    </li>
    <li>
        <span>خصوصیت</span>
        <span>{{ optional($order->variance)->title }}</span>
    </li>
    <li>
        <span>آدرس</span>
        <span>{{ optional($order->address)->address }}</span>
    </li>
    <li>
        <span>تاریخ ثبت</span>
        <span>{{ verta($order->created_at)->format("Y/m/d") }}</span>
    </li>
    @if(!! $order->post_tracking_code)
    <li>
        <span>کدرهگیری پست</span>
        <span>{{ $order->post_tracking_code }}</span>
    </li>
    @endif
    @if(!! $order->post_trackinged_at)
    <li>
        <span>تاریخ تحویل به پست</span>
        <span>{{ verta($order->post_trackinged_at)->format("Y/m/d") }}</span>
    </li>
    @endif
    @if( !$order->post_trackinged_at && !$order->post_tracking_code)
    <li>
        <span>وضعیت</span>
        <span class="text-primary">در حال فراهم سازی</span>
    </li>
    @endif
</ul>
