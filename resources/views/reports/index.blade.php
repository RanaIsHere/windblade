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

    <div id="reports-view" class="border-2 border-primary m-2">
        <div class="flex flex-row p-2">
            <div class="flex-1">
                <div class="overflow-x-auto">
                    <table class="table py-2 w-full select-none" id="transaction-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Customer</th>
                                <th>Paid</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactionData as $trd)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $trd->members->member_name }}</td>
                                    <td>Rp. {{ $trd->transaction_paid }}</td>
                                    <td>{{ $trd->transaction_date }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex-1 px-2">
                <div class="shadow stats stats-vertical lg:stats-horizontal w-full text-center select-none">
                    <div class="stat">
                        <div class="stat-title">Workers</div>
                        <div class="stat-value">{{ mt_rand(50, 100) }}</div>
                        <div class="stat-desc">Amount of hired workers</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Users</div>
                        <div class="stat-value">{{ Auth::user()->count() }}</div>
                        <div class="stat-desc">Amount of registered users</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Customers</div>
                        <div class="stat-value">{{ $memberData->count() }}</div>
                        <div class="stat-desc">Amount of members registered</div>
                    </div>
                </div>

                <canvas id="myChart" width="400" height="300"></canvas>
            </div>

            <div class="flex-1">
                <div class="shadow stats stats-vertical w-full text-center select-none">
                    <div class="stat">
                        <div class="stat-title">Gross Profit</div>
                        <div class="stat-value">Rp. {{ $transactionData->sum('transaction_paid') }}</div>
                        <div class="stat-desc">Uncalculated full profit</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Loss by Tax</div>
                        <div class="stat-value">Rp. {{ $transactionData->sum('transaction_tax') }}</div>
                        <div class="stat-desc">Profit lost by Tax</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Additional Fee</div>
                        <div class="stat-value">Rp. {{ $transactionData->sum('transaction_paid_extra') }}</div>
                        <div class="stat-desc">Profit gained through fees</div>
                    </div>

                    <div class="stat">
                        <div class="stat-title">Sold Quantity</div>
                        <div class="stat-value">
                            {{ $transactionData->sum('TransactionDetails.quantity') }}</div>
                        <div class="stat-desc">Quantity of items sold</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="schedule-view" class="hidden">
        <div class="flex flex-row">
            <div class="flex-1 p-4">

            </div>
        </div>
    </div>

    <div id="requests-view" class="hidden">
        <div class="flex flex-row">
            <div class="flex-1 p-4">

            </div>
        </div>
    </div>
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
                            {{ $turd->sum('transaction_paid') }},
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
