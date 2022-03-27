@extends('preload.default')

@section('container')
    @include('items.create')
    @include('items.delete')
    @include('items.edit')
    @include('items.import')
    @include('partials.header')

    <div class="flex flex-row m-4">
        <div class="flex-1">
            <p class="font-bold text-xl">Item Data</p>
        </div>
    </div>

    <div class="flex flex-row m-4">
        <div class="flex-1">
            <button class="btn btn-primary btn-sm mr-2" id="addDataBtn">Add Data</button>
            <a href="{{ route('export_item') }}" class="btn btn-info btn-sm mx-2"> Export </a>
            <button class="btn btn-warning btn-sm mx-2"
                onclick="document.getElementById('importModal').classList.add('modal-open')"> Import </button>
        </div>
    </div>

    <div class="flex flex-row m-4">
        <div class="flex-1">
            <table class="table w-full text-center py-4" id="item-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Item Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Paydate</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($itemData as $item)
                        <tr>
                            <td>
                                <span>{{ $loop->iteration }}</span>
                                <span class="hidden">{{ $item->id }}</span>
                            </td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->item_quantity }}</td>
                            <td>{{ $item->item_price }}</td>
                            <td>{{ $item->paydate }}</td>
                            <td>{{ $item->item_supplier }}</td>
                            <td>
                                <select class="select select-bordered w-full" onchange="updateStatus(this)"
                                    value="{{ $item->item_status }}">
                                    <option value="ORDERED" @if ($item->item_status === 'ORDERED') selected @endif>ORDERED
                                    </option>
                                    <option value="SOLD" @if ($item->item_status === 'SOLD') selected @endif>SOLD</option>
                                    <option value="AVAILABLE" @if ($item->item_status === 'AVAILABLE') selected @endif>AVAILABLE
                                    </option>
                                </select>
                            </td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" onclick="updateRow(this)">Edit</button>
                                |
                                <button class="btn btn-error btn-sm" onclick="deleteRow(this)">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('partials.notifications')
@endsection
