<!DOCTYPE html>
<html lang="en" data-theme="forest">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <title>Windblade - {{ $page_name }}</title>
    </head>

    <body>
        <div class="default-body">
            @yield('container')
        </div>

        <script src="{{ asset('js/windblade.js') }}"></script>
    </body>
</html>