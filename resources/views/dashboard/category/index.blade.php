@extends('dashboard.masters.layout')
@section('content')
<form class="settings" action="{{ route("dashboard.categories.store") }}" method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="col-sm-4">
            <div class="form-group has-top-label">
                <label>نام</label>
                <input name="name" class="form-control" placeholder="نام">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group has-top-label">
                <label>توضیحات</label>
                <input name="description" class="form-control" placeholder="توضیحات">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="__galleries picture border rounded"></div>
        </div>
    </div>
</form>
@endsection
