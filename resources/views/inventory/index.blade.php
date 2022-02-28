@extends('preload.default')

@section('container')
    @include('partials.modals')
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

    <div class="text-center my-10">
        <div class="btn-group inline-block">
            <button class="btn btn-outline btn-active w-32" id="inventory-view-btn">View</button>
            <button class="btn btn-outline w-32" id="inventory-creation-btn">Create</button>
        </div>
    </div>

    <div id="inventory-view" class="">
        <div class="overflow-x-auto p-2">
            <table class="table w-full py-2" id="inventory-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Product Brand</th>
                        <th>Quantity</th>
                        <th>Condition</th>
                        <th>Restock Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($inventoryData as $inv)
                        <tr>
                            <th>{{ $inv->id }}</th>
                            <td>{{ $inv->product_name }}</td>
                            <td>{{ $inv->product_brand }}</td>
                            <td>{{ $inv->quantity }}</td>
                            <td>{{ $inv->condition }}</td>
                            <td>{{ $inv->restock_date }}</td>
                            <td><button type="button" class="btn btn-primary"
                                    onclick="request_info(this, 'inventory_input' ,'updateInventoryModal')">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="inventory-creation" class="hidden">
        <form action="/inventory" method="post" class="text-center">
            @csrf
            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Condition Type</span>
                        </label>

                        <div class="flex-row">
                            <select name="condition" id="type_input" class="select select-bordered w-full">
                                <option value="NORMAL">NORMAL</option>
                                <option value="SLOW">SLOW</option>
                                <option value="BROKEN">BROKEN</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Restock Date</span>
                        </label>

                        <div class="flex-row">
                            <input type="date" name="restock_date" id="date-input" class="input input-bordered w-full"
                                required>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Product Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="product_name" id="name_input" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Product Brand</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="product_brand" id="brand_input" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Quantity</span>
                        </label>

                        <div class="input-group">
                            <input type="number" name="quantity" id="quantity_input" class="input input-bordered w-full"
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10">Create Package</button>
        </form>
    </div>
@endsection
