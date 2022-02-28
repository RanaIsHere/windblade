@extends('preload.default')

@section('container')
    @include('partials.header')

    @if (Session::has('success'))
        <div class="alert shadow-lg alert-success non-printable">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="mx-2">{{ Session::get('success') }}</span>
            </div>
        </div>
    @endif

    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <div class="flex flex-row mb-4 items-center">
                <div class="flex-1">
                    <p class="text-2xl font-bold">#<span id="invoiceCode">{{ $transactionData->invoice_code }}</span>
                    </p>
                </div>

                <div class="flex-1 text-right">
                    <p class="text-sm opacity-50" id="timeOfInvoice">{{ $transactionData->transaction_date }}</p>
                </div>
            </div>

            <div class="flex flex-row">
                <div class="flex-1 text-left">
                    <p class="font-bold">Customer:</p>

                    <address>
                        <span id="nameOfCustomer">{{ $transactionData->members->member_name }}</span>, <span
                            id="genderOfCustomer">{{ $transactionData->members->member_gender }}</span>
                        <p>+<span id="phoneOfCustomer">{{ $transactionData->members->member_phone }}</span></p>
                    </address>
                </div>

                <div class="flex-1 text-right">
                    <p class="font-bold">Outlet:</p>

                    <address>
                        <p id="nameOfOutlet">{{ $transactionData->outlets->outlet_name }}</p>
                        <p>+<span id="phoneOfOutlet">{{ $transactionData->outlets->outlet_phone }}</span></p>
                    </address>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row bg-base-200 my-5">
                <div class="flex-1">
                    <address class="text-left">
                        To:
                        <p class="my-2" id="sentTo">{{ $transactionData->members->member_address }}</p>
                    </address>
                </div>

                <div class="flex-1">
                    <address class="text-right">
                        From:
                        <p class="my-2" id="sentFrom">{{ $transactionData->outlets->outlet_address }}</p>
                    </address>
                </div>
            </div>

            <div class="printable">
                {{-- <div class="min-w-full min-h-full" id="invoice-package-table">
                    <div class="flex flex-row font-bold">
                        <div class="flex-1">#</div>
                        <div class="flex-1">PKG_NAME</div>
                        <div class="flex-1">PKG_TYPE</div>
                        <div class="flex-1">PKG_PRICE</div>
                        <div class="flex-1">QTY</div>
                    </div>

                    <div id="invoice-buffer-table">
                        @foreach ($invoiceData as $invoice)
                            <div class="flex flex-row">
                                <div class="flex-1">{{ $invoice->packages->id }}</div>
                                <div class="flex-1">{{ $invoice->packages->package_name }}</div>
                                <div class="flex-1">{{ $invoice->packages->package_type }}</div>
                                <div class="flex-1">{{ $invoice->packages->package_price }}</div>
                                <div class="flex-1">{{ $invoice->quantity }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex flex-row font-semibold">
                        <div class="flex-1"></div>
                        <div class="flex-1"></div>
                        <div class="flex-1">Subtotal</div>
                        <div class="flex-1"><span class="normal-case">Rp.</span> <span id="total_price">0</span>
                        </div>
                        <div class="flex-1" id="total_quantity">0</div>
                    </div>

                    <div class="flex flex-row font-bold">
                        <div class="flex-1"></div>
                        <div class="flex-1">Discount</div>
                        <div class="flex-1"><span
                                id="discount">{{ $transactionData->transaction_discount }}</span>%</div>
                        <div class="flex-1"><span class="normal-case">Rp.</span> <span
                                id="very_total">{{ $transactionData->transaction_paid }}</span></div>
                        <div class="flex-1"></div>
                    </div>
                </div> --}}

                <table class="table table-compact w-full min-h-full text-center" id="invoice-package-table">
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
                        @foreach ($invoiceData as $invoice)
                            <tr>
                                <th>{{ $invoice->packages->id }}</th>
                                <td>{{ $invoice->packages->package_name }}</td>
                                <td>{{ $invoice->packages->package_type }}</td>
                                <td>{{ $invoice->packages->package_price }}</td>
                                <td>{{ $invoice->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Additional Fee</th>
                            <th><span class="normal-case">Rp.</span> <span
                                    id="trans_fee">{{ $transactionData->transaction_paid_extra }}</span>
                            </th>
                            <th></th>
                        </tr>
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
                            <th><span id="discount">{{ $transactionData->transaction_discount }}</span>%</th>
                            <th><span class="normal-case">Rp.</span> <span
                                    id="very_total">{{ $transactionData->transaction_paid }}</span>
                            </th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="flex-row non-printable my-10">
        <div class="flex-1 text-center">
            <button class="btn btn-primary" onclick="window.print()">Print</button>
        </div>
    </div>
@endsection
