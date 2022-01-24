@extends('preload.default')

@section('container')

@include('partials.modals')

@include('partials.header')

<div class="text-center my-10">
    <div class="btn-group inline-block">
        <button class="btn btn-outline btn-active w-32" id="outlet-view-btn">View</button>
        <button class="btn btn-outline w-32" id="outlet-creation-btn">Create</button>
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
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($outletData as $util)
                <tr>
                    <th>{{ $util->id }}</th>
                    <td>{{ $util->outlet_name }}</td>
                    <td>{{ $util->outlet_address }}</td>
                    <td>{{ $util->outlet_phone }}</td>
                    <td>{{ $util->status }}</td>
                    <th><button type="button" class="btn btn-primary"
                            onclick="request_info(this, 'outlet_input_modal', 'outlet_input_real_modal', 'editoutlets')">Edit</button>
                    </th>
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