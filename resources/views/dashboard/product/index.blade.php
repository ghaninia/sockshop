@extends('dashboard.masters.layout')
@section('content')
<div class="tasks m-0">
    <div class="container">
        <div class="titr">
            <a data-toggle="tooltip" data-placement="top" title="جدید" class="round" href="{{ route("dashboard.products.create") }}">
                <button type="button" class="btn round">
                    <i class="feather-plus"></i>
                </button>
            </a>
            <form dir="rtl" class="search">
                <input value="{{ request('s') }}" name="s" type="search" class="form-control" placeholder="فیلتر" />
                <button type="button" class="btn prepend">
                    <i class="feather-filter"></i>
                </button>
            </form>
        </div>
        <div class="list">
            <div class="row">
                @foreach( $products as $product)
                <div class="col-lg-6">
                    <div class="item mb-3">
                        <div class="content">
                            <a href="{{ route("dashboard.products.edit" , $product->slug ) }}">
                                <h5 class='d-block'>{{ $product->title }}</h5>
                            </a>
                            <a href="{{ route("dashboard.products.destroy" , $product->slug ) }}" class="remove">
                                <i class="feather-trash"></i>
                            </a>
                            <div class="badge mb-0 badge-warning rounded">
                                تعداد فروش :
                                {{ $product->orders_count }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div align="center" class="mt-5">
            {{ $products->links("pagination::bootstrap-4") }}
        </div>
    </div>
</div>
@endsection
