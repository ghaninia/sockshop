<nav class="navigation">
    <div class="container">
        <button type="button" class="btn toggler collapsed" data-toggle="collapse" data-target="#content" aria-controls="content">
            <span class="icon"></span>
        </button>
        <div class="menu collapse" id="content">
            <ul id="menu">
                <li>
                    <a href="{{ route("dashboard.categories.index") }}">
                        <i class="feather-grid"></i>
                        <span>دسته بندی</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("dashboard.products.index") }}">
                        <i class="feather-shopping-cart"></i>
                        <span>محصولات</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("dashboard.orders.index") }}">
                        <i class="feather-send"></i>
                        <span>سفارشات</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route("dashboard.option.index") }}">
                        <i class="feather-settings"></i>
                        <span>تنظیمات</span>
                    </a>
                </li>
            </ul>
            <div class="user">
                <div class="dropdown">
                    <button type="button" class="btn" data-toggle="dropdown">
                        <img src="{{ avatar() }}" alt="avatar" />
                    </button>
                    <div class="dropdown-menu">
                        <a href="sign-in.html" class="dropdown-item">خروج</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
