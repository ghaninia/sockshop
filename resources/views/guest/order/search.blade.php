<!-- Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body table-responsive">
                <ul>
                    <li>
                        <span>سفارش دهنده</span>
                        <p>{{ $order->fullname }}</p>
                    </li>
                    <li>
                        <span>شماره موبایل</span>
                        <p>{{ $order->mobile }}</p>
                    </li>
                    <li>
                        <span>شماره پیگیری :</span>
                        <p>{{ $order->tracking_code }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
