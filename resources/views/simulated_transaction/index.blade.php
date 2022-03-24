@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 mx-4">
            <p class="font-bold text-lg">Simulated Item Transaction</p>
        </div>
    </div>

    <form id="transactForm">
        <div class="flex flex-row border-black border-2 mx-4">
            <div class="flex-1 p-2">
                <div class="form-control">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Worker ID</span>
                        </label>

                        <div class="flex">
                            <input type="number" name="worker_id" id="idInput" min="1" value="1"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Package Name</span>
                        </label>

                        <div class="flex-row">
                            <select name="package" id="packageInput" class="select select-sm select-bordered w-full"
                                onchange="changePackage(this)" required>
                                <option disabled selected>Choose package</option>
                                <option value="DETERGENT">Detergent</option>
                                <option value="PERFUME">Perfume</option>
                                <option value="SHOE_DETERGENT">Shoe Detergent</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Quantity</span>
                        </label>

                        <div class="flex">
                            <input type="number" name="quantity" id="quantityInput" min="1" value="1"
                                class="input input-sm input-bordered w-full" required>
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
                            <span class="label-text">Transaction Date</span>
                        </label>

                        <div class="flex">
                            <input type="date" name="transactionDate" id="dateInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Package Price</span>
                        </label>

                        <div class="flex-row">
                            <p class="mx-1">Rp. <span id="priceInput">0</span></p>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Transaction Type</span>
                        </label>

                        <div class="flex flex-row m-1">
                            <div class="label cursor-pointer mr-2">
                                <input type="radio" name="radioOptions" id="cashRadioInput"
                                    class="radio radio-primary radioInputs">
                                <span class="label-text mx-2">Cash</span>
                            </div>

                            <div class="label cursor-pointer mr-2">
                                <input type="radio" name="radioOptions" id="transferRadioInput"
                                    class="radio radio-primary radioInputs">
                                <span class="label-text mx-2">E-Money/Transfer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <div class="flex flex-row">
                    <div class="flex-1">
                        <button class="btn btn-info btn-sm m-2" onclick="sort(getArray(), 'id')">Sort</button>
                    </div>

                    <div class="flex-1">
                        <div class="max-w-[20rem] flex flex-row">
                            <label class="label cursor-pointer">
                                <input type="checkbox" checked="checked" class="checkbox checkbox-primary"
                                    id="checkBoxSortMoney">
                                <span class="label-text mx-4">E-Money/Transfer</span>
                            </label>

                            <label class="label cursor-pointer">
                                <input type="checkbox" checked="checked" class="checkbox checkbox-primary"
                                    id="checkBoxSortCash">
                                <span class="label-text mx-4">Cash</span>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="flex-none m-4">
            <div class="input-group">
                <input type="search" name="search" id="searchInput" class="input input-bordered input-sm"
                    oninput="search(this, 'transactor-table')">
                <button type="button" class="btn btn-info btn-sm"
                    onclick="search(document.getElementById('searchInput'), 'transactor-table')">Search</button>
            </div>
        </div>
    </div>
    <table class="table w-full text-center" id="transactor-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction Date</th>
                <th>Package Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Discount</th>
                <th>Total Price</th>
                <th>Transaction Type</th>
            </tr>
        </thead>

        <tbody>
            {{-- <tr>
                <td>1</td>
                <td>2022-03-21</td>
                <td>Detergent</td>
                <td>15000</td>
                <td>2</td>
                <td>0</td>
                <td>30000</td>
                <td>CASH</td>
            </tr>

            <tr>
                <td>2</td>
                <td>2022-03-21</td>
                <td>Perfume</td>
                <td>10000</td>
                <td>5</td>
                <td>1500</td>
                <td>48500</td>
                <td>E-MONEY</td>
            </tr>

            <tr>
                <td>3</td>
                <td>2022-03-22</td>
                <td>Shoe Detergent</td>
                <td>15000</td>
                <td>2</td>
                <td>0</td>
                <td>30000</td>
                <td>E-MONEY</td>
            </tr>

            <tr>
                <td>4</td>
                <td>2022-03-22</td>
                <td>Perfume</td>
                <td>15000</td>
                <td>2</td>
                <td>0</td>
                <td>30000</td>
                <td>CASH</td>
            </tr> --}}
        </tbody>

        <tfoot>
            <tr>
                <td colspan="3" class="text-center">TOTAL</td>
                <td id="totalTableNormalPrice">0</td>
                <td id="totalTableQuantity">0</td>
                <td id="totalTableDiscount">0</td>
                <td id="totalTablePrice">0</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
    </div>
@endsection
