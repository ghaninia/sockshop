@extends("guest.layouts.master")
@section("main")
<x-feature />
<div class="categories container" id="products">
    @foreach($categories as $category)
    <div class="row">
        <div class="col-12">
            <div class="category" id="{{ $category->slug }}">
                @if(picture($category , true))
                <div class="cover">
                    <div class="img">
                        <img src="{{ picture($category) }}" alt="{{ $category->name }}" title="{{ $category->name }}" />
                    </div>
                </div>
                @endif
                <div>
                    <h1>{{ $category->name }}</h1>
                    <p>{{ $category->description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row products">
        @foreach($category->products as $product)
        @php($gallery = gallery($product , "medium") )
        <div class="col-lg-4 col-sm-6 col-xs-12" id="{{ $product->slug }}">
            <div class="product">
                @if(count($gallery))
                <div class="slider slick">
                    @foreach($gallery as $pic)
                    <div class="slide">
                        <img src="{{ $pic }}" alt="{{ $product->summary }}" title="{{ $product->title }}">
                    </div>
                    @endforeach
                </div>
                @else
                <div class="cover">
                    <img src="{{ picture($product , "medium") }}" alt="{{ $product->summary }}" title="{{ $product->title }}">
                </div>
                @endif
                <div class="information">
                    <h2 class="title">
                        {{ $product->title }}
                    </h2>
                    <h6 class="description">{{ $product->summary }}</h6>
                </div>
                <form class="needs-validation" novalidate="" method="POST" action="{{ route("guest.order.store" , ['product' => $product->slug ]) }}">
                    @csrf
                    <div class="variances">
                        @foreach($product->variances as $variance)
                        <input name="variance" id="variance__{{ $variance->id }}" {{ $loop->index == 0 ? 'checked' : NULL  }} class="hidden" type="radio" value="{{ $variance->id }}">
                        <label data-toggle="tooltip" data-placement="top" title="{{ $variance->tooltip }}" class="variance waves-effect waves-light" for="variance__{{ $variance->id }}">
                            <div class="title">{{ $variance->title }}</div>
                            <div class="price">
                                <span>{{ $variance->getPrice() }}</span>
                                <span>{{ $variance->getPriceUnit() }}</span>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    <div class="has-float-label form-group">
                        <input pattern="{{ config('site.regex.persian.front') }}" required class="form-control" name="fullname" placeholder="نام و نام خانوادگی" />
                        <label><i class="feather-user"></i></label>
                        <div class="invalid-feedback">نام و نام خانوادگی باید فقط شامل کلمات فارسی باشد.</div>
                    </div>
                    <div class="has-float-label form-group">
                        <input required pattern="{{ config('site.regex.mobile.front') }}" class="form-control" pattern="{{ config('site.regex.mobile.front') }}" name="mobile" placeholder="شماره موبایل" />
                        <label><i class="feather-tablet"></i></label>
                        <div class="invalid-feedback">فرمت شماره موبایل صحیح نمی‌باشد.</div>
                    </div>
                    <div class="has-float-label form-group">
                        <textarea maxlength="{{ config('site.address') }}" rows="3" required class="form-control" name="address" placeholder="نشانی ارسال (مثال : تهران ،لویزان، شهرک نفت، پلاک 1)"></textarea>
                        <label><i class="feather-map"></i></label>
                        <div class="invalid-feedback">نشانی ارسال الزامی می‌باشد.حداکثر 200 کاراکتر می‌باشد</div>
                    </div>
                    <button class="bg-gradient waves-effect waves-light">
                        <span>ثبت سفارش</span>
                        <i class="feather-chevrons-left"></i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
<x-question />
@stop
