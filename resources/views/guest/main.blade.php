@extends("layouts.master")
@section("main")

    <div class="section" id="features" tabindex="-1">
        <div class="container">
            <div class="section-title">
                <small>شاخص های سرویس های ما</small>
                <h3>ویژگی هایی که به آنها افتخار میکنیم</h3>
            </div>
            <div class="row">

                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-lock gradient-fill ti-3x ml-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">امنیت </h4>
                                    <p class="card-text">بالا بردن سطح امنیت اکانت اینستاگرام شما جلوگیری از ورود <b>عوامل خارجی</b> به اکانت شما</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-unlink gradient-fill ti-3x ml-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">بازیابی</h4>
                                    <p class="card-text">بازیابی اکانت های از دست رفته شما پس گیری اکانت شما از <b>عوامل خارجی</b> در سریع ترین زمان ممکن </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="card features">
                        <div class="card-body">
                            <div class="media">
                                <span class="ti-instagram gradient-fill ti-3x ml-3"></span>
                                <div class="media-body">
                                    <h4 class="card-title">فروش فالوور تضمینی</h4>
                                    <p class="card-text">تمام سرویس های که تو اینستا نیاز داری از فالوور ،لایک ، ویو و ... از ما بگیر , فرصتی طلایی برای بهتر دیده شدن</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- // end .section -->

    <!-- followers -->
    @if($followers->isNotEmpty())
        <div class="section light-bg" id="services" tabindex="-1">
            <div class="container">
                <div class="section-title">
                    <small> نیترو های موجود برای </small>
                    <h4>افزایش فالوور</h4>
                </div>
                <div class="row">
                    @foreach($followers as $follower)
                        <div class="col-lg-4">
                            <div class="card features ">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-user gradient-fill ti-3x ml-3"></span>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $follower->title }}</h5>
                                            <p>{{ sprintf("%s تومان" , number_format($follower->price) ) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route("order" , $follower->id) }}" method="POST" data-toggle="validator">
                                        @csrf
                                        <div class="form-group">
                                            <label for="phonenumber-{{$follower->id}}">شماره موبایل</label>
                                            <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="phonenumber-{{$follower->id}}" required name="phonenumber" value="{{ request("phonenumber") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url-{{$follower->id}}">نام کاربری</label>
                                            <input autocomplete="off" class="form-control" id="url-{{$follower->id}}" required name="url" value="{{ request("url") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <button class="btn btn-primary">خرید بسته نیترو</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small>{{ $follower->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- likes -->
    @if($likes->isNotEmpty())
        <div class="section bg-dark">
            <div class="container">
                <div class="section-title">
                    <small> نیترو های موجود برای </small>
                    <h4 class="text-white">افزایش لایک</h4>
                </div>
                <div class="row">
                    @foreach($likes as $like)
                        <div class="col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-user gradient-fill ti-3x ml-3"></span>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $like->title }}</h5>
                                            <p>{{ sprintf("%s تومان" , number_format($like->price) ) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route("order" , $like->id) }}" method="POST" data-toggle="validator">
                                        @csrf
                                        <div class="form-group">
                                            <label for="phonenumber-{{$like->id}}">شماره موبایل</label>
                                            <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="phonenumber-{{$like->id}}" required name="phonenumber" value="{{ request("phonenumber") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url-{{$like->id}}">آدرس پست اینستاگرام</label>
                                            <input pattern="^(https:\/\/(www\.)?instagram.com\/p\/.+)$" dir="ltr" placeholder="https://instagram.com/p/***" autocomplete="off" class="form-control" id="url-{{$like->id}}" required name="url" value="{{ request("url") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <button class="btn btn-primary">خرید بسته نیترو</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small>{{ $like->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- views -->
    @if($views->isNotEmpty())
        <div class="section dark-bg">
            <div class="container">
                <div class="section-title">
                    <small> نیترو های موجود برای </small>
                    <h4 class="text-white"> افزایش بازدید پست <b>(ویو پست)</b></h4>
                </div>
                <div class="row">
                    @foreach($views as $view)
                        <div class="col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-user gradient-fill ti-3x ml-3"></span>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $view->title }}</h5>
                                            <p>{{ sprintf("%s تومان" , number_format($view->price) ) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route("order" , $view->id) }}" method="POST" data-toggle="validator">
                                        @csrf
                                        <div class="form-group">
                                            <label for="phonenumber-{{$view->id}}">شماره موبایل</label>
                                            <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="phonenumber-{{$view->id}}" required name="phonenumber" value="{{ request("phonenumber") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url-{{$view->id}}">آدرس پست اینستاگرام</label>
                                            <input pattern="^(https:\/\/(www\.)?instagram.com\/p\/.+)$" dir="ltr" placeholder="https://instagram.com/p/***" autocomplete="off" class="form-control" id="url-{{$view->id}}" required name="url" value="{{ request("url") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <button class="btn btn-primary">خرید بسته نیترو</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small>{{ $view->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- stories -->
    @if($stories->isNotEmpty())
        <div class="section ">
            <div class="container">
                <div class="section-title">
                    <small> نیترو های موجود برای </small>
                    <h4>افزایش بازدید استوری</h4>
                </div>
                <div class="row">
                    @foreach($stories as $story)
                        <div class="col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-user gradient-fill ti-3x ml-3"></span>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $story->title }}</h5>
                                            <p>{{ sprintf("%s تومان" , number_format($story->price) ) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route("order" , $story->id) }}" method="POST" data-toggle="validator">
                                        @csrf
                                        <div class="form-group">
                                            <label for="phonenumber-{{$story->id}}">شماره موبایل</label>
                                            <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="phonenumber-{{$story->id}}" required name="phonenumber" value="{{ request("phonenumber") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url-{{$story->id}}">نام کاربری اینستاگرام</label>
                                            <input dir="ltr" autocomplete="off" class="form-control" id="url-{{$story->id}}" required name="url" value="{{ request("url") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <button class="btn btn-primary">خرید بسته نیترو</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small>{{ $story->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- igtv -->
    @if($igvs->isNotEmpty())
        <div class="section  light-bg ">
            <div class="container">
                <div class="section-title">
                    <small> نیترو های موجود برای </small>
                    <h4>افزایش بازدید IGTV</h4>
                </div>
                <div class="row">
                    @foreach($igvs as $igv)
                        <div class="col-lg-4">
                            <div class="card features">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="ti-user gradient-fill ti-3x ml-3"></span>
                                        <div class="media-body">
                                            <h5 class="card-title">{{ $igv->title }}</h5>
                                            <p>{{ sprintf("%s تومان" , number_format($igv->price) ) }}</p>
                                        </div>
                                    </div>
                                    <form action="{{ route("order" , $igv->id) }}" method="POST" data-toggle="validator">
                                        @csrf
                                        <div class="form-group">
                                            <label for="phonenumber-{{$igv->id}}">شماره موبایل</label>
                                            <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="phonenumber-{{$igv->id}}" required name="phonenumber" value="{{ request("phonenumber") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="url-{{$igv->id}}">لینک پست اینستاگرام</label>
                                            <input pattern="(https:\/\/(www\.)?instagram.com\/tv\/.+)$" placeholder="https://instagram.com/tv/***" dir="ltr" autocomplete="off" class="form-control" id="url-{{$igv->id}}" required name="url" value="{{ request("url") }}">
                                            <div class="badge badge-danger help-block with-errors"></div>
                                        </div>
                                        <button class="btn btn-primary">خرید بسته نیترو</button>
                                    </form>
                                </div>
                                <div class="card-footer">
                                    <small>{{ $igv->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    <!-- // end .section -->
    <div class="section " id="security" tabindex="-1">
        <div class="container">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#secure">امنیت حساب کاربری</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#recovery">بازیابی حساب کاربری</a>
                </li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane fade show active" id="secure">
                    <div class="row">
                        <div class="col-lg-4">
                            <img class="img-fluid" src="{{ asset("assets/img/secure.svg") }}" >
                        </div>
                        <div class="col-lg-4">
                            <p class="lead mt-4">با کمترین هزینه <b>عمر</b> اکانت خودتون رو تضمین کنید شما میتونید یک اکانت کاملا امن داشته باشید , فرم رو پر کنید تا متخصصمون بهتون زنگ بزنه ; گوشه ی از فعالیت ما :</p>
                            <ul class="mt-4">
                                <li>بستن دسترسی اپلیکیشن های واسط</li>
                                <li>محافظت حساب مقابل اتک های خارجی (بروت فورس و پسورد لیست ها , ...)</li>
                                <li>استفاده از رمز نگاری مطمئن</li>
                                <li>امنیت در احراز هویت</li>
                                <li>تایید حساب اینستاگرام</li>
                            </ul>
                        </div>
                        <div class="col-lg-4">
                            <form class="security" action="{{ route("security") }}" method="POST" data-toggle="validator">
                                @csrf
                                <input type="hidden" name="action" value="security">
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل</label>
                                    <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="mobile" type="text" required name="mobile" value="{{ request("mobile") }}">
                                    <div class="badge badge-danger help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">اکانت اینستاگرام</label>
                                    <input autocomplete="off" class="form-control" type="text" id="username" required name="username" value="{{ request("username") }}">
                                    <div class="badge badge-danger help-block with-errors"></div>
                                </div>
                                <button class="btn btn-primary btn-sm">درخواست سفارش</button>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="recovery">
                    <div class="row">

                        <div class="col-lg-4">
                            <form class="security" action="{{ route("security") }}" method="POST" data-toggle="validator">
                                @csrf
                                <input type="hidden" name="action" value="recovery">
                                <div class="form-group">
                                    <label for="mobile">شماره موبایل</label>
                                    <input pattern="^09[0-9]{9}$" autocomplete="off" class="form-control" id="mobile" type="text" required name="mobile" value="{{ request("mobile") }}">
                                    <div class="badge badge-danger help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <label for="username">اکانت اینستاگرام</label>
                                    <input autocomplete="off" class="form-control" type="text" id="username" required name="username" value="{{ request("username") }}">
                                    <div class="badge badge-danger help-block with-errors"></div>
                                </div>
                                <button class="btn btn-primary btn-sm">درخواست سفارش</button>
                            </form>
                        </div>

                        <div class="col-lg-4">
                            <h4 class="mt-4">بازیابی و بازگردانی</h4>
                            <p class="mt-4"> اکانت های حذف شده و یا هک شده و یا اکانتی که گذرواژه آن را فراموش کردید شما با پر کردن فرم سفارشتون رو ثبت میکنید و متخصصین ما با شما تماس میگیرند .</p>
                        </div>

                        <div class="col-lg-4">
                            <img class="img-fluid" src="{{ asset("assets/img/recovery.svg") }}" >
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    

    <!-- Asked Questions -->

    <div class="section light-bg" id="questions" tabindex="-1" >
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled ui-steps">
                        <li class="media">
                            <div class="circle-icon mr-4">1</div>
                            <div class="media-body">
                                <h5>امکان خرید عمده با قیمت پایین تر هست؟</h5>
                                <p>بله دوستانی که مایل به بازاریابی هستند میتوانند با شماره <b>09337545453</b> تماس بگیرند و از قیمت پایین بهره بردار شوند.</p>
                            </div>
                        </li>
                        <li class="media my-4">
                            <div class="circle-icon mr-4">2</div>
                            <div class="media-body">
                                <h5>نحوه پرداخت به چه صورت است</h5>
                                <p>پرداخت توسط درگاه پرداخت اینترنتی و با استفاده از تمام کارت های بانکی متصل به شبکه شتاب انجام می شود.</p>
                            </div>
                        </li>
                        <li class="media">
                            <div class="circle-icon mr-4">3</div>
                            <div class="media-body">
                                <h5>به چه صورت میتوانیم در تماس باشیم؟</h5>
                                <p>پشتیبانی سایت در روز های اداری از ساعت 12 ظهر تا 9 شب در تلگرام،پاسخگوی تمام مشتریان عزیز میباشد.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled ui-steps">
                        <li class="media">
                            <div class="circle-icon mr-4">4</div>
                            <div class="media-body">
                                <h5>آیا لازم است رمز عبور صفحه را به شما بدهم؟</h5>
                                <p>خیر، تنها به آی دی شما احتیاج داریم و رمز عبور لازم نیست.</p>
                            </div>
                        </li>
              
                        <li class="media">
                            <div class="circle-icon mr-4">5</div>
                            <div class="media-body">
                                <h5>پر کردن فیلد سفارش</h5>
                                <p>در جایی که فیلد نام کاربری اینستاگرام گفته شده شما باید فقط فقط نام کاربری اینستاگرام بدون هیچ پسوند و پیشوندی وارد نمایید.</p>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

@stop