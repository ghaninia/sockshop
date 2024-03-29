<x-navbar />
<header class="bg-gradient" id="home">
    @switch($routeName)

    @case("guest.main")
    <div class="container mt-5">
        <h1>
            {{ options("shop_title") }}
        </h1>
        <p class="tagline">
            {{ options("shop_description") }}
        </p>
    </div>
    <div class="header-cover">
        <img src="{{ asset("assets/guest/images/wallpaper.png") }}">
        <img src="{{ asset("assets/guest/images/wallpaper.png") }}">
        <img src="{{ asset("assets/guest/images/wallpaper.png") }}">
    </div>
    @break

    @case("guest.order.factor")
        <h5 class="text-center">
            فاکتور
        </h5>
    @break
    @endswitch
</header>
