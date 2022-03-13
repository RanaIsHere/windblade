@extends('preload.default')

@section('container')
    @include('partials.header')
    @include('partials.notifications')

    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <div class="tabs mx-auto justify-center" id="tabsMenu">
                @if (Auth::user()->roles === 'OWNER')
                    <a id="report-tab" class="tab tab-lg tab-bordered tab-active text-opacity-100 changeTabs">
                        Reports
                    </a>

                    <a id="schedule-tab" class="tab tab-lg tab-bordered changeTabs">
                        Schedule
                    </a>

                    {{-- Temporarily disabled --}}
                    {{-- <a id="request-tab" class="indicator tab tab-lg tab-bordered changeTabs">
                    Requests
                </a> --}}
                @endif

                @if (Auth::user()->roles === 'ADMIN')
                    <a id="request-tab" class="indicator tab tab-lg tab-bordered changeTabs">
                        Logs
                    </a>
                @endif

            </div>
        </div>
    </div>

    @if (Auth::user()->roles === 'OWNER')
        @include('reports.reports_view')
        @include('reports.schedule_view')
    @endif

    {{-- @include('reports.requests_view') --}}

    @if (Auth::user()->roles === 'ADMIN')
        @include('reports.logs_view')
    @endif
@endsection

@if (Auth::user()->roles === 'OWNER')
    @push('charts')
        <script>
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'Rupiah',
                        data: [
                            @foreach ($transactionData as $turd)
                                {{ $turd->transaction_paid }},
                            @endforeach
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    @endpush
@endif
