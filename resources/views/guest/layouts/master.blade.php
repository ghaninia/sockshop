<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ logo("favicon") }}" type="image/x-icon">
    {!! SEO::generate() !!}
    <script>
        const config = {
            token: '{{ csrf_token() }}',
        };
        Object.freeze(config);
    </script>
    <link rel="stylesheet" href="{{ mix('assets/guest/css/bundle.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/guest/css/app.css') }}">
</head>

<body data-spy="scroll" data-target="#navbar" data-offset="30">
    <x-header />
    @yield("main")
    <script src="{{ mix("assets/guest/js/app.js") }}"></script>
</body>

</html>
