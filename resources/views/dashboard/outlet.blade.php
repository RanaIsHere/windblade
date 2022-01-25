@extends('preload.default')

@section('container')

@include('partials.modals')

@include('partials.header')

@if(Session::has('success'))
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

<div class="text-center my-10">
    <div class="btn-group inline-block">
        <button type="button" class="btn btn-primary"
            onclick="request_info(this, 'outlet_input_modal', 'outlet_input_real_modal', 'editoutlets')">Edit</button>
    </div>
</div>

<div id="outlet-view" class="">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Outlet Name</th>
                    <th>Outlet Address</th>
                    <th>Outlet Contact</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($outletData as $util)
                <tr>
                    <th id="table_outlet_id">{{ $util->id }}</th>
                    <td>{{ $util->outlet_name }}</td>
                    <td>{{ $util->outlet_address }}</td>
                    <td>{{ $util->outlet_phone }}</td>
                    <td>{{ $util->status }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="outlet-creation" class="hidden">
    <form action="/outlet" method="post" class="text-center">
        @csrf

        <div class="flex flex-row">
            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Business Status</span>
                    </label>

                    <div class="flex-row">
                        <select name="status" id="type_input" class="select select-lg select-bordered w-full">
                            <option value="CLOSED">Closed</option>
                            <option value="ACTIVE">Active</option>
                            <option value="BANKRUPT">Bankrupt</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Outlet Name</span>
                    </label>

                    <div class="flex-row">
                        <input type="text" name="outlet_name" id="name_input" class="input input-bordered w-full"
                            maxlength="100" required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Outlet Address</span>
                    </label>

                    <div class="flex-row">
                        <input type="text" name="outlet_address" id="address_input" class="input input-bordered w-full"
                            required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Outlet Phone Number</span>
                    </label>

                    <div class="input-group">
                        <span>+62</span>
                        <input type="text" name="outlet_phone" id="contact_input" class="input input-bordered w-full"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-10">Create Outlet</button>
    </form>
</div>
@endsection