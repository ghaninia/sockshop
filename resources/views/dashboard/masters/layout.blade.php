<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    <link rel="shortcut icon" href="{{ logo("favicon") }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix("assets/dashboard/css/bundle.css") }}" type="text/css">
    <link rel="stylesheet" href="{{ mix("assets/dashboard/css/app.css") }}" type="text/css">
    <link rel="shortcut icon" href="{{ config("site.favicon") }}" type="image/x-icon">
    <script>
        const config = {
            token: '{{ csrf_token() }}',
        };
        Object.freeze(config);
    </script>
</head>

<body>
        @if(request()->is("auth/*"))
            @yield("content")
        @else
            <div class="nav-side">
                @include("dashboard.masters.side")
                <div class="main">
                    <div class="container">
                        <div class="hero">
                            @yield("content")
                        </div>
                    </div>
                </div>
            </div>
        @endif
    <script src="{{ mix("assets/dashboard/js/app.js") }}"></script>
</body>

</html>
