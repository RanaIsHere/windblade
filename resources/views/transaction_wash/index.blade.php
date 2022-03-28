@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 mx-4">
            <p class="font-bold text-lg">Simulasi Transaksi Cucian</p>
        </div>
    </div>

    <form id="transaction_form">
        <div class="flex flex-row border-black border-2 mx-4">
            <div class="flex-1 p-2">
                <div class="form-control">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">No. Transaksi</span>
                        </label>

                        <div class="flex">
                            <input type="number" name="transaction_id" id="idInput" min="1" value="1"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">No. HP/WA</span>
                        </label>

                        <div class="flex">
                            <input type="text" name="contact_number" id="contactInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Jenis Cucian</span>
                        </label>

                        <div class="flex-row">
                            <select name="laundry_type" id="laundryInput" class="select select-sm select-bordered w-full"
                                required>
                                <option disabled selected>Choose package</option>
                                <option value="Standar">Standar</option>
                                <option value="Express">Express</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row text-center my-4">
                    <div class="flex-1">
                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                </div>
            </div>

            <div class="flex-1 p-2">
                <div class="flex-1 mx-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama Pelanggan</span>
                        </label>

                        <div class="flex">
                            <input type="text" name="customer_name" id="customerInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Tanggal Cuci</span>
                        </label>

                        <div class="flex">
                            <input type="date" name="laundry_date" id="dateInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Berat</span>
                        </label>

                        <div class="input-group">
                            <input type="number" name="weight" id="weightInput" class="input input-sm input-bordered w-full"
                                min="0" value="0" step="0.1" required>
                            <span>Kg</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <div class=" flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <div class="flex flex-row">
                    <div class="flex-1">
                        <button class="btn btn-info btn-sm m-2" onclick="sort(getArray(), 'id')">Sort</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-none m-4">
            <form id="searchForm">
                <div class="input-group">
                    <input type="search" name="search" id="searchInput" class="input input-bordered input-sm">
                    <button type="submit" class="btn btn-info btn-sm">Search</button>
                </div>
            </form>
        </div>
    </div>
    <table class="table w-full text-center" id="transaction-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Kontak</th>
                <th>Tanggal Cuci</th>
                <th>Jenis Cucian</th>
                <th>Berat</th>
                <th>Diskon</th>
                <th>Total Harga</th>
            </tr>
        </thead>

        <tbody>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="5" class="text-center">TOTAL</td>
                <td id="totalTableWeight">0</td>
                <td id="totalTableDiskon">0</td>
                <td id="totalTableHarga">0</td>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
    </div>
@endsection
