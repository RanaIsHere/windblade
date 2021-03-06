@extends('preload.default')

@section('container')
    @include('partials.modals')
    @include('partials.importer')
    @include('partials.header')

    @if (Session::has('success'))
        <div class="alert alert-success" id="alert-div">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <label>{{ Session::get('success') }}</label>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="document.getElementById('alert-div').remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert shadow-lg alert-error">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    @foreach ($errors->all() as $errors)
                        {{ $errors }}
                    @endforeach
                </span>
            </div>
        </div>
    @endif

    <div class="text-center my-10">
        <div class="btn-group inline-block">
            <button class="btn btn-outline btn-active w-32" id="customer-view-btn">View</button>
            <button class="btn btn-outline w-32" id="customer-creation-btn">Create</button>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-outline w-32 rounded-r-md rounded-l-none">More</label>
                <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-72">
                    <li><a href="/customers/export" role="button" class="btn btn-outline w-full my-2">Export as CSV</a>
                    </li>
                    <li><button class="btn btn-outline w-full my-2" onclick="link_href('/customers/import')">Import</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="customer-view" class="">
        <div class="overflow-x-auto p-2">
            <table class="table w-full" id="customer-table">
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
                    @foreach ($customerData as $member)
                        <tr>
                            <th>{{ $member->id }}</th>
                            <td>{{ $member->member_name }}</td>
                            <td>{{ $member->member_address }}</td>
                            <td>+{{ $member->member_phone }}</td>
                            <td>{{ $member->member_gender }}</td>
                            <th><button type="button" class="btn btn-primary"
                                    onclick="request_info(this, 'outlet_input_modal', 'outlet_input_real_modal', 'editcustomers')">Edit</button>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="customer-creation" class="hidden">
        <form action="/customer" method="post" class="text-center">
            @csrf
            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Gender</span>
                        </label>

                        <div class="flex-row">
                            <select name="member_gender" id="type_input" class="select select-lg select-bordered w-full">
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="member_name" id="name_input" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Address</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="member_address" id="address_input" class="input input-bordered w-full"
                                required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Phone Number</span>
                        </label>

                        <div class="input-group">
                            <span>+62</span>
                            <input type="text" name="member_phone" id="contact_input" class="input input-bordered w-full"
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10">Create Member</button>
        </form>
    </div>
@endsection
