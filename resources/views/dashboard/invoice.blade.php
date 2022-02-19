@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="max-w-full flex-1 p-4">
            <div class="flex flex-row mb-4 items-center">
                <div class="flex-1">
                    <p class="text-2xl font-bold">#{{ $transaction->invoice_code }}</p>
                </div>
                <div class="flex-1 text-right">
                    <p class="text-sm opacity-50">{{ $transaction->transaction_date }}</p>
                </div>
            </div>
            <div class="flex flex-row">
                <div class="flex-1 text-left">
                    <p class="font-bold">Customer:</p>
                    <address>
                        <span id="nameOfCustomer">{{ $transaction->members->member_name }}</span>, <span
                            id="genderOfCustomer">{{ $transaction->members->member_gender }}</span>
                        <p>+<span id="phoneOfCustomer">{{ $transaction->members->member_phone }}</span></p>
                    </address>
                </div>
                <div class="flex-1 text-right">
                    <p class="font-bold">Outlet:</p>
                    <address>
                        <p id="nameOfOutlet">{{ $transaction->outlets->outlet_name }}</p>
                        <p>+<span id="phoneOfOutlet">{{ $transaction->outlets->outlet_phone }}</span></p>
                    </address>
                </div>
            </div>
            <div class="flex flex-col lg:flex-row bg-base-200 my-5">
                <div class="flex-1">
                    <address class="text-left">
                        To:
                        <p class="my-2" id="sentTo">{{ $transaction->members->member_address }}</p>
                    </address>
                </div>
                <div class="flex-1">
                    <address class="text-right">
                        From:
                        <p class="my-2" id="sentFrom">{{ $transaction->outlets->outlet_address }}</p>
                    </address>
                </div>
            </div>
            <table class="table w-full table-compact text-center" id="invoice-package-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Package Name</th>
                        <th>Package Type</th>
                        <th>Package Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody id="invoice-buffer-table">
                    @foreach ($transaction_details as $transact)
                        <tr>
                            <th>{{ $transact->packages->id }}</th>
                            <td>{{ $transact->packages->package_name }}</td>
                            <td>{{ $transact->packages->package_type }}</td>
                            <td>{{ $transact->packages->package_price }}</td>
                            <td>{{ $transact->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Subtotal</th>
                        <th><span class="normal-case">Rp.</span> <span id="total_price"></span></th>
                        <th id="total_quantity">0</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>Discount</th>
                        <th><span id="discount"></span>%</th>
                        <th><span class="normal-case">Rp.</span> <span id="very_total"></span></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
