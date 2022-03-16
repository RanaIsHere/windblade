<!DOCTYPE html>
<html lang="en" data-theme="emerald">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('dataTables/datatables.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">

    <title> Windblade - {{ $page_name }} </title>
</head>

<body>
    <div class="default-body">
        @yield('container')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/windblade.js') }}"></script>

    <script type="text/javascript" src="{{ asset('dataTables/datatables.min.js') }}"></script>

    @if ($page_name == 'Simulation')
        <script src="{{ asset('js/simulation.js') }}"></script>
    @endif

    @if ($page_name == 'Register')
        <script src="{{ asset('js/register.js') }}"></script>
    @endif

    @if ($page_name == 'Packages')
        <script src="{{ asset('js/package.js') }}"></script>
    @endif

    @if ($page_name == 'Outlets')
        <script src="{{ asset('js/outlet.js') }}"></script>
    @endif

    @if ($page_name == 'Customers')
        <script src="{{ asset('js/customer.js') }}"></script>
    @endif

    @if ($page_name == 'Users')
        <script src="{{ asset('js/user.js') }}"></script>
    @endif

    @if ($page_name == 'Transactions')
        <script src="{{ asset('js/transactions.js') }}"></script>
        <script src="{{ asset('js/calculation.js') }}"></script>
    @endif

    @if ($page_name == 'Invoices')
        <script src="{{ asset('js/invoice.js') }}"></script>
    @endif

    @if ($page_name == 'Invoice')
        <script src="{{ asset('js/print.js') }}"></script>
    @endif

    @if ($page_name == 'Reports')
        <script src="{{ asset('socket.io/dist/socket.io.min.js') }}"></script>
        <script src="{{ asset('js/reports.js') }}"></script>
    @endif

    @if ($page_name == 'Inventory')
        <script src="{{ asset('js/inventory.js') }}"></script>
    @endif

    @if ($page_name == 'Reports')
        @stack('charts')
    @endif

    @if ($page_name == 'Salaries')
        <script src="{{ asset('js/salary.js') }}"></script>
    @endif

    @if ($page_name == 'Delivery')
        @stack('deliveries')
    @endif
</body>

</html>
