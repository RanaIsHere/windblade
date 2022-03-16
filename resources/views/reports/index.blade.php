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
            function getAllDataFromCorrespondingMonth() {
                $.ajax({
                    type: 'POST',
                    url: '/getSumFromMonths',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        let monthly = response.transaction_monthly
                        let yearly = response.transaction_yearly
                        let monthly_data = []
                        let yearly_data = []

                        for (let i = 0; i < monthly.length; i++) {
                            monthly_data.push(monthly[i].transaction_paid)
                        }

                        for (let i = 0; i < yearly.length; i++) {
                            yearly_data.push(yearly[i].transaction_paid)
                        }

                        let monthly_sum = monthly_data.reduce((a, b) => a + b, 0)
                        let yearly_sum = yearly_data.reduce((a, b) => a + b, 0)

                        return monthly_data
                    }
                });
            }


            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Rupiah',
                        data: [
                            console.log(getAllDataFromCorrespondingMonth())
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
