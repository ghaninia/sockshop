<div class="section tracking" id="tracking">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <form class="needs-validation" novalidate="" action="{{ route('guest.search') }}" method="POST">
                    @csrf
                    <div class="form-row mb-0">
                        <div class="col">
                            <div class="has-float-label form-group">
                                <input required pattern="{{ config('site.regex.mobile.front') }}" class="form-control" pattern="{{ config('site.regex.mobile.front') }}" name="mobile" placeholder="شماره موبایل" />
                                <label><i class="feather-tablet"></i></label>
                                <div class="invalid-feedback">فرمت شماره موبایل صحیح نمی‌باشد.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="has-float-label form-group">
                                <input required class="form-control" name="tracking_code" placeholder="کد رهگیری" />
                                <label><i class="feather-slack"></i></label>
                                <div class="invalid-feedback">کدرهگیری الزامی می‌باشد.</div>
                            </div>
                        </div>
                    </div>
                    <div class="has-float-label form-group mt-0 captcha">
                        <input name="captcha" required class="form-control mt-0" name="tracking_code" placeholder="کدکپچــا" />
                        <label><i class="feather-unlock"></i></label>
                        <img src="{{ route("captcha") }}" alt="">
                        <div class="invalid-feedback">کدکپچــا الزامی می‌باشد.</div>
                    </div>
                    <button class="bg-gradient waves-effect waves-light btn-block">
                        <span>پیگیری سفارش</span>
                        <i class="feather-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-lg-4 content hidden">
            </div>
        </div>
    </div>
</div>
