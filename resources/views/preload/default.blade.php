<!DOCTYPE html>
<html lang="en" data-theme="emerald">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <title> Windblade - {{ $page_name }} </title>
    </head>

    <body>
        <div class="default-body">
            @yield('container')
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/windblade.js') }}"></script>

        @if($page_name == 'Register')
            <script src="{{ asset('js/register.js') }}"></script>
        @endif

        @if($page_name == 'Packages')
            <script src="{{ asset('js/package.js') }}"></script>
        @endif

        @if($page_name == 'Outlets')
        <script src="{{ asset('js/outlet.js') }}"></script>
        @endif

        @if($page_name == 'Customers')
        <script src="{{ asset('js/customer.js') }}"></script>
        @endif

        @if ($page_name == 'Users')
            <script src="{{ asset('js/user.js') }}"></script>
        @endif

        @if ($page_name == 'Transactions')
            <script src="{{ asset('js/transactions.js') }}"></script>
        @endif
    </body>

</html>