<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ logo("favicon") }}" type="image/x-icon">
    <script>
        const config = {
            token: '{{ csrf_token() }}',
        };
        Object.freeze(config);
    </script>
    <link rel="stylesheet" href="{{ asset('assets/guest/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/guest/css/app.css') }}">
</head>
<body  data-spy="scroll" data-target="#navbar" data-offset="30">
    <div class="nav-menu fixed-top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-dark navbar-expand-lg">

                        <a class="navbar-brand " href="{{ route("guest.main") }}">
                            {{  options("title") }}
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbar">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"> <a class="nav-link active" href="#home">خانه <span class="sr-only">(شما اینجا هستید)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#features">خدمات ما</a> </li>
                                <li class="nav-item"> <a class="nav-link" href="#questions">سوال متداول</a> </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- @if ( in_array(Route::currentRouteName(), array('contact-us','about-us','tos','verify')) )
        <header class="bg-gradient" id="home">
            <div class="container mt-5">
                <p class="tagline">@if(Route::currentRouteName()=='contact-us')ارتباط با ما@elseif(Route::currentRouteName()=='about-us')درباره ما@elseif(Route::currentRouteName()=='tos')قوانین و شرایط استفاده@elseif(Route::currentRouteName()=='verify')پرداخت@endif</p>
            </div>
            <br><br>
        </header>
    @else --}}
        <header class="bg-gradient" id="home">
            <div class="container mt-5">
                <h1>
                    {{ options("shop_title") }}
                </h1>
                <p class="tagline">
                    {{ options("shop_description") }}
                </p>
            </div>
            <div class="img-holder">
                <div id="outerContainer">
                    <div id="container">
                        <a href="#services">
                            <div id="item">
                            </div>
                        </a>
                        <div class="circle" style="animation-delay: 0s"></div>
                        <div class="circle" style="animation-delay: 1s"></div>
                        <div class="circle" style="animation-delay: 2s"></div>
                        <div class="circle" style="animation-delay: 3s"></div>
                    </div>
                </div>
                <img src="{{ asset("assets/img/followbala.png") }}" alt="phone" class="img-fluid">
            </div>
        </header>
    {{--  @endif --}}

    @yield("main")

    <!-- <div class="dark-bg pt-3 pb-2" id="contact" tabindex="-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <p class="pt-2 text-white">©صاحب امتیاز تمامی حقوق وب‌سایت، فالو بالا می باشد.</p>
                </div>
                <div class="col-lg-5">
                    <p class="text-white pt-2"> شماره پشتیبانی و پیگیری سفارش : <b>09337545453</b></p>
                </div>
                <div class="col-lg-2">
                    <div class="social-icons">
                        <a href="http://facebook.com/followbala"><span class="ti-facebook"></span></a>
                        <a href="http://twitter.com/followbala"><span class="ti-twitter-alt"></span></a>
                        <a href="http://instagram.com/Topcars.ir"><span class="ti-instagram"></span></a>
                        <a href="https://t.me/m_2303"><span class="ti-location-arrow"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

</body>
</html>
