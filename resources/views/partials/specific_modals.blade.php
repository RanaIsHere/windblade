@if ($page_name == 'Transactions')
    <div id="find_member" class="modal">
        <div class="modal-box min-w-full text-center">
            <div class="flex flex-row">
                <div class="flex-1 my-2">
                    <div class="flex flex-row my-2">
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Search</label>
                                <input type="search" name="package-sort" id="package-sort"
                                    oninput="search(this, 'customer-transaction-table')"
                                    class="input input-primary input-bordered">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full" id="customer-transaction-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Customer Contact</th>
                            <th>Customer Gender</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($memberData as $member)
                            <tr>
                                <th>{{ $member->id }}</th>
                                <td>{{ $member->member_name }}</td>
                                <td>{{ $member->member_address }}</td>
                                <td>{{ $member->member_phone }}</td>
                                <td>{{ $member->member_gender }}</td>

                                <th>
                                    <button type="button" class="btn btn-accent"
                                        onclick="get_member(this, 0)">Pick</button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('find_member').classList.remove('modal-open')">Cancel</button>
            </div>
        </div>
    </div>
@endif

@if ($page_name == 'Transactions')
    <div id="find_package" class="modal">
        <div class="modal-box min-w-full">
            <div class="flex flex-row">
                <div class="flex-1 my-2">
                    <div class="flex flex-row my-2">
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Search</label>
                                <input type="search" name="package-sort" id="package-sort"
                                    oninput="search(this, 'package-transaction-table')"
                                    class="input input-primary input-bordered">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full" id="package-transaction-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Type</th>
                            <th>Package Name</th>
                            <th>Package Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody id="package-buffer-list">
                        @foreach ($packageData as $package)
                            <tr>
                                <th>{{ $package->id }}</th>
                                <td>{{ $package->package_type }}</td>
                                <td>{{ $package->package_name }}</td>
                                <td>{{ $package->package_price }}</td>

                                <th>
                                    <button type="button" class="btn btn-accent"
                                        onclick="add_package(this)">Add</button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('find_package').classList.remove('modal-open')">Cancel</button>
            </div>
        </div>
    </div>
@endif

@if ($page_name == 'Invoices')
    <div id="view_invoice" class="modal">
        <div class="modal-box max-w-2xl">
            <div class="flex flex-col lg:flex-row mb-4 items-center">
                <div class="flex-1">
                    <p class="text-2xl font-bold">#<span id="invoiceCode"></span></p>
                </div>

                <div class="flex-1 text-right">
                    <p class="text-sm opacity-50" id="timeOfInvoice"></p>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row">
                <div class="flex-1 text-left">
                    <p class="font-bold">Customer:</p>

                    <address>
                        <span id="nameOfCustomer"></span>, <span id="genderOfCustomer"></span>
                        <p>+<span id="phoneOfCustomer"></span></p>
                    </address>
                </div>

                <div class="flex-1 text-right">
                    <p class="font-bold">Outlet:</p>

                    <address>
                        <p id="nameOfOutlet"></p>
                        <p>+<span id="phoneOfOutlet"></span></p>
                    </address>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row bg-base-200 my-5">
                <div class="flex-1">
                    <address class="text-left">
                        To:
                        <p class="my-2" id="sentTo"></p>
                    </address>
                </div>

                <div class="flex-1">
                    <address class="text-right">
                        From:
                        <p class="my-2" id="sentFrom"></p>
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
                    {{-- <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr> --}}
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

            <div class="modal-action">
                <button type="button" class="btn btn-primary" onclick="exit_invoice()">Cancel</button>
            </div>
        </div>
    </div>
@endif
