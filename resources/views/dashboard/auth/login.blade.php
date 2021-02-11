@extends("dashboard.masters.layout")
@section("content")
<div class="sign">
    <div class="container">
        <div class="item">
            <img src="{{ logo() }}" alt="{{ options("title") }}">
            <form class="needs-validation" novalidate="" id="form" action="{{ route("auth.login.store") }}" method="post">
                @csrf
                <div class="form-group">
                    <label>پست الکترونیکی</label>
                    <input required type="email" name="email" class="form-control" placeholder="پست الکترونیکی را وارد کنید">
                    <button type="button" class="btn prepend">
                        <i class="feather-mail"></i>
                    </button>
                </div>
                <div class="form-group">
                    <label>کلمه ی عبور</label>
                    <input required type="password" name="password" class="form-control" placeholder="کلمه عبور را وارد کنید">
                    <button type="button" class="btn prepend">
                        <i class="feather-lock"></i>
                    </button>
                </div>
                <div class="form-group captcha">
                    <label>کد کپچا</label>
                    <input required name="captcha" class="form-control">
                    <button type="button" class="btn prepend ">
                        <img src="{{ route("captcha") }}" alt="">
                    </button>
                </div>
                <button class="btn primary">ورود</button>
            </form>
        </div>
    </div>
</div>
@stop
