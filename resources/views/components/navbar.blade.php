<header class="header-area  fixed-top >
    <div class="nav-area host-nav-area">
        <div class="navbar-area">
            <div class="mobile-nav">
                <a href="{{ route('guest.main') }}" class="logo">
                    <img src="{{ logo() }}" alt="{{ options('title') }}" />
                </a>
            </div>
            <div class="main-nav">
                 <nav class="navbar navbar-expand-lg navbar-light navbar-light-three">
                    <div class="container">
                        <a class="navbar-brand" href="{{ route('guest.main') }}">
                            <img src="{{ logo() }}" alt="{{ options('title') }}" />
                        </a>
                        <div class="collapse navbar-collapse mean-menu">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#home">خانه</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#features">امکانات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#service">خدمات</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#testimonial">مشتریان</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#blog">وبلاگ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contact">تماس با ما</a>
                                </li>
                            </ul>
                            <div class="others-option app">
                                <div class="host-nav-wrap">
                                    <div class="side-icon">
                                        <button type="button" class="btn modal-btn" data-toggle="modal" data-target="#myModalRight">
                                            <i class="feather-menu"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>

<div id="myModalRight" class="modal fade modal-right" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <img src="{{ logo() }}" alt="{{ options('title') }}" />
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2>{{ options('title') }}</h2>
                <p>{!! options('description') !!}</p>
                <div class="seo-service-area">
                    @if(options('support_mobile') )
                    <div class="service-item p-2 mb-2">
                        <a href="tell:{{ options('support_mobile') }}">
                            <i class="feather-tablet ml-2"></i>
                            {{ options('support_mobile') }}
                        </a>
                    </div>
                    @endif
                    @if(options('support_phone') )
                    <div class="service-item p-2 mb-2">
                        <a href="tell:{{ options('support_phone') }}">
                            <i class="feather-phone-call ml-2"></i>
                            {{ options('support_phone') }}
                        </a>
                    </div>
                    @endif
                    @if(options('support_email') )
                    <div class="service-item p-2 ">
                        <a href="mailto:{{ options('support_email') }}">
                            <i class="feather-mail ml-2"></i>
                            {{ options('support_email') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
