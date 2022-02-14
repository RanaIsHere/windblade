@if ($page_name == 'Transactions')
    <div id="find_member" class="modal">
        <div class="modal-box min-w-full text-center">
            <div class="flex flex-row">
                <div class="flex-1 my-2">
                    <div class="flex flex-row">
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Sort by</label>
                                <select id="sort_by" class="select mx-2">
                                    <option value="CUSTOMER_NAME">Customer Name</option>
                                    <option value="CUSTOMER_CONTACT">Customer Contact</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Group by</label>
                                <select id="sort_by" class="select mx-2">
                                    <option value="ASCENDING">Ascending</option>
                                    <option value="DESCENDING">Descending</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Search</label>
                                <input type="search" name="package-sort" id="package-sort" class="input input-primary input-bordered">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
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
                                    <button type="button" class="btn btn-accent" onclick="get_member(this, 0)">Pick</button>
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
                    <div class="flex flex-row">
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Sort by</label>
                                <select id="sort_by" class="select mx-2">
                                    <option value="PACKAGE_NAME">Package Name</option>
                                    <option value="PACKAGE_TYPE">Package Type</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Group by</label>
                                <select id="sort_by" class="select mx-2">
                                    <option value="ASCENDING">Ascending</option>
                                    <option value="DESCENDING">Descending</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex-1">
                            <div class="form-control mx-2">
                                <label class="label">Search</label>
                                <input type="search" name="package-sort" id="package-sort" class="input input-primary input-bordered">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Package Type</th>
                            <th>Package Name</th>
                            <th>Package Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($packageData as $package)
                            <tr>
                                <th>{{ $package->id }}</th>
                                <td>{{ $package->package_type }}</td>
                                <td>{{ $package->package_name }}</td>
                                <td>{{ $package->package_price }}</td>

                                <th>
                                    <button type="button" class="btn btn-accent" onclick="get_package(this, 0)">Add</button>
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
    <div class="modal-box min-w-full text-center">
        {{-- <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Code</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Package Name</th>
                        <th>Package Type</th>
                        <th>Package Price</th>
                    </tr>
                </thead>
    
                <tbody>
                    @foreach ($transactionData as $transact)
                        <tr>
                            <th id="transaction_id"></th>
                            <td id="invoice_code"></td>
                            <td id="member_name"></td>
                            <td id="member_phone"></td>
                            <td id="package_name"></td> 
                            <td id="package_type"></td> 
                            <td>Rp. <span id="package_price"></span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}

        

        <div class="modal-action">
            <button type="button" class="btn btn-primary"
                onclick="document.getElementById('view_invoice').classList.remove('modal-open')">Cancel</button>
        </div>
    </div>
</div>
@endif