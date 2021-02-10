@extends('dashboard.masters.layout')
@section('content')
<div class="tasks m-0">
    <div class="container">
        <div class="titr">
            <button data-toggle="tooltip" data-placement="top" title="جدید"  type="button" class="btn round" data-toggle="modal" data-target="#new-project">
                <i class="feather-plus"></i>
            </button>
            <form dir="rtl" class="search">
                <input value="{{ request('s') }}" name="s" type="search" class="form-control" placeholder="فیلتر" />
                <button type="button" class="btn prepend">
                    <i class="feather-filter"></i>
                </button>
            </form>
        </div>
        <div class="list">
            <div class="row">
                @foreach( $categories as $category)
                <div class="col-lg-6">
                    <div class="item mb-3">
                        <div class="content">
                            <small>{{ $category->name }}</small>
                            <a href="{{ route("dashboard.categories.destroy" , $category->id ) }}" class="remove">
                                <i class="feather-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div align="center" class="mt-5">
            {{ $categories->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
@include("dashboard.category.create")
@endsection
