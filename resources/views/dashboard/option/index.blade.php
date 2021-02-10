@extends("dashboard.masters.layout")
@section("content")
<form id="form" class="needs-validation settings" novalidate="" action="{{ route("dashboard.option.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="item">
        <div class="form-group">
            <label for="title">نام سایت</label>
            <input value="{{ options("title") }}" required type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">توضیحات سایت</label>
            <textarea name="description" id="description" class="form-control">{{ options("description") }}</textarea>
        </div>
        <div class="form-group">
            <label for="description">کلمات کلیدی سایت</label>
            <div class="keywords __additive" data-old="{!! options(" keywords") !!}"></div>
        </div>
        <div class="form-group">
            <label for="copyright">کپی رایت سایت</label>
            <textarea name="copyright" id="copyright" class="form-control">{{ options("copyright") }}</textarea>
        </div>
        <hr>
        <div class="form-row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="support_mobile">موبایل پشتیبانی</label>
                    <input value="{{ options("support_mobile") }}" id="support_mobile" name="support_mobile" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="support_phone">تلفن پشتیبانی</label>
                    <input value="{{ options("support_phone") }}" id="support_phone" name="support_phone" class="form-control">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="support_email">ایمیل پشتیبانی</label>
                    <input value="{{ options("support_email") }}" id="support_email" name="support_email" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="shop_description">درباره فروشگاه</label>
            <textarea name="shop_description" id="shop_description" class="form-control">{{ options("shop_description") }}</textarea>
        </div>
        <div class="form-row">
            <div class="col-sm-6">
                <div data-oldest="{{ options("logo") }}" class="logo __galleries mb-4"></div>
            </div>
            <div class="col-sm-6">
                <div data-oldest="{{ options("favicon") }}" class="favicon __galleries mb-4"></div>
            </div>
        </div>
        <button class="btn primary">ذخیره تغییرات</button>
    </div>
</form>

@endsection
