<div id="reports-view" class="border-2 border-primary m-2">
    <div class="flex flex-row p-2">
        <div class="flex-1">
            <div class="text-center">
                <a href="/reports/export/transactions" class="btn btn-sm m-2 btn-primary">Export as XLSX</a>
                <a href="/reports/export/transactions" class="btn btn-sm m-2 btn-primary">Export as PDF</a>
            </div>

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
