@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <div class="tabs mx-auto justify-center">
                <a id="report-tab" class="tab tab-lg tab-bordered tab-active text-opacity-100" onclick="change_tab(this)">
                    Reports
                </a>

                <a id="schedule-tab" class="tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Schedule
                </a>

                <a id="request-tab" class="indicator tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Requests
                    <span id="request-counter" class="indicator-item badge hidden">0</span>
                </a>

                <a id="request-tab" class="indicator tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Logs
                    <span id="request-counter" class="indicator-item badge hidden">0</span>
                </a>
            </div>
        </div>
    </div>

    @include('reports.reports_view')

    @include('reports.schedule_view')

    @include('reports.requests_view')

    @include('reports.logs_view')
@endsection

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
