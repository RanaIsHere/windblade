@extends('preload.default')

@section('container')
    @include('partials.specific_modals')
    @include('partials.header')

    <div id="invoice-view" class="">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Code</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Package Type</th>
                        <th>Transaction Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($transactionData as $transact)
                        <tr>
                            <th>{{ $transact->id }}</th>
                            <td>{{ $transact->invoice_code }}</td>
                            <td>{{ $transact->members->member_name }}</td>
                            <td>{{ $transact->members->member_phone }}</td> 
                            <td>{{ $transact->transactionDetails->packages->package_type }}</td> 
                            <td>Rp. {{ $transact->transaction_paid }}</td>
                            <th>
                                <button type="button" class="btn btn-primary" onclick="view_invoice(this)">View</button>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection