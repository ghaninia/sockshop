@extends('dashboard.masters.layout')
@section('content')
<form class="needs-validation settings form  pb-0 pt-0" novalidate="" action="{{ route("dashboard.profile.store") }}" method="POST">
    @csrf
    <div class="item">
        <div class="form-row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="fullname">نام کامل</label>
                    <input value="{{ $user->fullname }}" type="text" name="fullname" id="fullname" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="email">پست الکترونیکی</label>
                    <input value="{{ $user->email }}" required type="email" name="email" id="email" class="form-control">
                </div>
            </div>
        </div>
        <button class="btn primary">ویرایش حساب کاربری</button>
    </div>
</form>
<form class="needs-validation settings form" novalidate="" action="{{ route("dashboard.profile.password") }}" method="POST">
    @csrf
    <div class="item">
        <div class="form-row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password">گذرواژه</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password_confirmation">تایید گذرواژه</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                </div>
            </div>
        </div>
        <button class="btn primary">ویرایش گذرواژه</button>
    </div>
</form>
@endsection
