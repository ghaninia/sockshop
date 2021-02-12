<!DOCTYPE html>
<html lang="en">

<head>
    {!! SEO::generate() !!}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ logo("favicon") }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix("assets/guest/css/bundle.css") }}">
    <link rel="stylesheet" href="{{ mix("assets/guest/css/app.css") }}">
    <script>
        const config = {
            token: "{{ csrf_token() }}",
        };
        Object.freeze(config);
    </script>
</head>

<body>
    @include("guest.layouts.header")
    @yield("content")
    <script async src="{{ mix("assets/guest/js/app.js") }}"></script>
</body>

</html>
