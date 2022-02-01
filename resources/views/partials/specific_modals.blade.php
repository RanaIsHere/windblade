@if ($page_name == 'Transactions')
    <div id="find_member" class="modal">
        <div class="modal-box min-w-full text-center">
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
        <div class="modal-box min-w-full text-center">
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
                                    <button type="button" class="btn btn-accent" onclick="get_package(this, 0)">Pick</button>
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