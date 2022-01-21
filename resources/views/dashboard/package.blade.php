@extends('preload.default')

@section('container')

@include('partials.header')

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
                        <td>{{ $pkg->outlet_id }}</td>
                        <td>{{ $pkg->package_name }}</td>
                        <td>{{ $pkg->package_type }}</td>
                        <td>{{ $pkg->package_price }}</td>
                        <th><button type="button" class="btn btn-primary">Edit</button></th>
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
                        <input type="text" name="id_outlet" id="outlet_input" class="input input-bordered w-full"
                            readonly>
                        <button type="button" class="btn btn-primary mx-2" id="outlet_search"> Find Outlet </button>
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
                            maxlength="100">
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
                        <input type="number" name="package_price" id="price_input" class="input input-bordered w-full">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-10">Create Package</button>
    </form>
</div>
@endsection