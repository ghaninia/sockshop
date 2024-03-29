<div class="nav-menu fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-dark navbar-expand-lg">

                    <a class="navbar-brand " href="{{ route("guest.main") }}">
                        <img src="{{ logo() }}" alt="{{ options('title_shop') }}">
                        {{ options("title") }}
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"> <a class="nav-link active" href="{{ route('guest.main') }}#home">خانه <span class="sr-only">(شما اینجا هستید)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('guest.main') }}#features">خدمات ما</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('guest.main') }}#products">محصولات</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('guest.main') }}#questions">سوالات متداول</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('guest.main') }}#tracking">رهگیری سفارش</a></li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
