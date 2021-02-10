@extends("dashboard.masters.layout")
@section("content")
<form id="form" class="needs-validation settings" novalidate=""  action="{{ route("dashboard.products.store") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="item">
        <div class="form-row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="title">نام محصول</label>
                    <input required type="text" name="title" id="title" class="form-control">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="summary">مختصر</label>
                    <input type="text" name="summary" id="summary" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="description">توضیحات</label>
                    <textarea required name="description" id="description" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="categories">دسته بندی ها</label>
                    <select class="form-control" name="categories[]" multiple>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-12">
                <div class="__additive keywords">
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-3">
                <div class="picture __galleries"></div>
            </div>
            <div class="col-sm-9">
                <div class="gallery __galleries"></div>
            </div>
        </div>
    </div>
    <div class="item mt-4 border">
        <div class="form-row">
            <div class="col-sm-12">
                <!-- لیست قیمت -->
                <div class="form-group m-0">
                    <label for="">لیست قیمت</label>
                    <ul class="prices variances"></ul>
                </div>
            </div>
        </div>
    </div>
    <button class="btn primary mt-4">ثبت محصول</button>
</form>
@stop
