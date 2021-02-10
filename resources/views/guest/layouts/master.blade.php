<!DOCTYPE html>
<html lang="en">

<head>
    {!! SEO::generate() !!}
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        const config = {
            token: "{{ csrf_token() }}",
        };
        Object.freeze(config);
    </script>
</head>

<body>
    @yield("content")
</body>

</html>
