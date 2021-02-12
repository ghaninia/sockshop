<x-navbar />
<div class="container">
    <div id="home" class="host-banner-area">
        <div class="banner-shape">
            <img src="{{ asset('assets/guest/images/header-bg.png') }}" alt="">
        </div>
        <div class="banner-text">
            <h1>{{ options('title') }}</h1>
        </div>
        <div class="banner-img">
            <img src="{{ asset('assets/guest/images/header.png') }}" alt="Host">
        </div>
        <div class="container">
            <div class="banner-content">
                <h1>{{ options('shop_title') }}</h1>
                <p>{{ options('shop_description') }}</p>
                <div class="banner-form">
                    <form id="search" action="{{ route('guest.search') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="mobile" placeholder="شماره همراه">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input required type="text" class="form-control" name="tracking_code" placeholder="شماره تراکنش">
                                </div>
                            </div>
                            <button class="btn host-form-btn">پیگیری آنی
                                <i class="feather-chevron-left"></i>
                            </button>
                        </div>
                        <div class="output"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
