@extends("dashboard.masters.layout")
@section("content")
<div class="sign">
    <div class="container">
        <div class="item">
            <h2>ورود</h2>
            <form dir="rtl">
                <div class="form-group">
                    <label>نام کاربری</label>
                    <input type="text" class="form-control" placeholder="نام کاربری خود را وارد نمایید">
                    <button class="btn prepend">
                    </button>
                </div>
                <div class="form-group">
                    <label>کلمه ی عبور</label>
                    <a href="forgot-password.html">کلمه عبور را فراموش کرده اید؟</a>
                    <input type="password" class="form-control" placeholder="کلمه عبور را وارد کنید">
                    <button class="btn prepend">
                    </button>
                </div>
                <button class="btn primary">ورود</button>
            </form>
        </div>
    </div>
</div>
@stop
