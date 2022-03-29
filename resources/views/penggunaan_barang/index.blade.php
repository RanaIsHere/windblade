@extends('preload.default')

@section('container')
    @include('penggunaan_barang.create')
    @include('penggunaan_barang.edit')
    @include('penggunaan_barang.delete')
    @include('penggunaan_barang.importer')

    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 mx-4">
            <p class="font-bold text-lg">Data Penggunaan Barang</p>
        </div>
    </div>

    <div class=" flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <div class="flex flex-row">
                    <div class="flex-1">
                        <button class="btn btn-info btn-sm m-2" onclick="openModal('addModal')">Tambah Data</button>
                        <a href="{{ route('export_data_usage') }}" class="btn btn-info btn-sm m-2">Export</a>
                        <button class="btn btn-info btn-sm m-2" onclick="openModal('importModal')">Import</button>
                    </div>
                </div>
            </div>
        </div>

        <div class=" flex-none m-4">
            <form id="searchForm">
                <div class="input-group">
                    <input type="search" name="search" id="searchInput" class="input input-bordered input-sm">
                    <button type="submit" class="btn btn-info btn-sm">CARI</button>
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto p-2">
        <table class="table w-full text-center p-2" id="usage-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Waktu Pakai</th>
                    <th>Waktu Beres</th>
                    <th>Nama Pemakai</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($usageData as $data)
                    <tr>
                        <td>
                            <span>{{ $loop->iteration }}</span>
                            <span class="hidden">{{ $data->id }}</span>
                        </td>
                        <td>{{ $data->nama_barang }}</td>
                        <td>{{ $data->waktu_pakai }}</td>
                        <td>{{ $data->waktu_beres }}</td>
                        <td>{{ $data->nama_pemakai }}</td>
                        <td>
                            <select class="select select-bordered w-full" onchange="updateStatus(this)"
                                value="{{ $data->status }}">
                                <option value="SELESAI" @if ($data->status === 'SELESAI') selected @endif>Selesai
                                </option>
                                <option value="BELUM_SELESAI" @if ($data->status === 'BELUM_SELESAI') selected @endif>Belum
                                    Selesai
                                </option>
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="updateRow(this)">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('partials.notifications')
@endsection
