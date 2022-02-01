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
        <button class="btn btn-outline btn-active w-32" id="package-view-btn">View</button>
        <button class="btn btn-outline w-32" id="package-creation-btn">Create</button>
    </div>
</div>

<div id="package-view" class="">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Outlet Name</th>
                    <th>Package Name</th>
                    <th>Package Type</th>
                    <th>Package Price</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($packageData as $pkg)
                <tr>
                    <th>{{ $pkg->id }}</th>
                    <td>{{ $pkg->outlets->outlet_name }}</td>
                    <td>{{ $pkg->package_name }}</td>
                    <td>{{ $pkg->package_type }}</td>
                    <td>{{ $pkg->package_price }}</td>
                    <th><button type="button" class="btn btn-primary"
                            onclick="request_info(this, 'outlet_input_modal', 'outlet_input_real_modal', 'editpackages')">Edit</button>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="package-creation" class="hidden">
    <form action="/package" method="post" class="text-center">
        @csrf
        <div class="flex flex-row">
            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Outlet ID</span>
                    </label>

                    <div class="input-group">
                        <input type="hidden" name="outlet_id" id="outlet_input_real"
                            value="{{ Auth::user()->outlet_id }}">
                        <input type="text" id="outlet_input" class="input input-bordered w-full"
                            value="{{ Auth::user()->outlets->outlet_name }}" readonly>
                    </div>
                </div>
            </div>

            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Package Name</span>
                    </label>

                    <div class="flex-row">
                        <input type="text" name="package_name" id="name_input" class="input input-bordered w-full"
                            maxlength="100" required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Package Type</span>
                    </label>

                    <div class="flex-row">
                        <select name="package_type" id="type_input" class="select select-bordered w-full">
                            <option value="HEAVY">Heavy-Duty</option>
                            <option value="BLANKET">Blanket</option>
                            <option value="BED_COVER">Bed Cover</option>
                            <option value="SHIRTS">Shirt</option>
                            <option value="OTHERS">Others</option>
                        </select>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Package Price</span>
                    </label>

                    <div class="input-group">
                        <span>Rp.</span>
                        <input type="number" name="package_price" id="price_input" class="input input-bordered w-full"
                            required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-10">Create Package</button>
    </form>
</div>
@endsection