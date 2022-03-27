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
        {{-- @include('reports.requests_view') --}}
    @endif

    @if (Auth::user()->roles === 'ADMIN')
        @include('reports.logs_view')
    @endif
@endsection

@if (Auth::user()->roles === 'OWNER')
    @push('charts')
        <script>
            const month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']

            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: month,
                    datasets: [{
                        label: 'Rupiah',
                        data: [],
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

            getAllDataFromCorrespondingMonth()

            /**
             * Get all data from corresponding month by AJAX request, and then 
             */
            function getAllDataFromCorrespondingMonth() {
                $.ajax({
                    type: 'POST',
                    url: '/reports/getSumFromMonths',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        let monthly = response.transaction_monthly
                        let monthly_data = []

                        for (let i = 0; i < monthly.length; i++) {
                            let transaction_date = monthly[i].transaction_date
                            let transaction_paid = monthly[i].transaction_paid

                            if (i === 0) {
                                monthly_data.push({
                                    x: month[new Date(transaction_date).getMonth()],
                                    y: transaction_paid
                                })
                            } else {
                                let last_transaction_date = monthly[i - 1].transaction_date
                                let last_transaction_paid = monthly_data[monthly_data.length - 1].y

                                if (month[new Date(transaction_date).getMonth()] ===
                                    month[new Date(last_transaction_date).getMonth()]) {

                                    monthly_data[monthly_data.length - 1].y += transaction_paid
                                } else {
                                    monthly_data.push({
                                        x: month[new Date(transaction_date).getMonth()],
                                        y: transaction_paid
                                    })
                                }
                            }
                        }

                        myChart.data.datasets[0].data = monthly_data
                        // console.log(myChart.data.datasets[0].data)
                        myChart.update();
                    }
                });
            }
        </script>
    @endpush
@endif
