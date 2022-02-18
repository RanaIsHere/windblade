@extends('preload.default')

@section('container')
    @include('partials.specific_modals')
    @include('partials.header')

    @if (Session::has('success'))
        <div class="alert alert-success">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <label>{{ Session::get('success') }}</label>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if (Session::has('failure'))
        <div class="alert shadow-lg alert-error">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ Session::get('failure') }}</span>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <div class="w-full shadow stats text-center mb-4">
        <div class="stat">
            <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                    </path>
                </svg>
            </div>

            <span class="stat-title">Price</span>
            <span class="stat-value text-primary my-2">Rp. <span id="price_view">0</span> </span>
            <span class="stat-desc"><span id="discount_view">0</span>% Discount</span>
        </div>

        <div class="stat">
            <div class="stat-figure text-info">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                    </path>
                </svg>
            </div>

            <span class="stat-title">Additional Fee</span>
            <span class="stat-value text-info my-2">Rp. <span id="fee_view">0</span></span>
            <span class="stat-desc">Fee gained from special requirement</span>
        </div>

        <div class="stat">
            <div class="stat-figure text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-8 h-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                    </path>
                </svg>
            </div>

            <span class="stat-title">Tax</span>
            <span class="stat-value text-accent my-2">Rp. <span id="tax_view">0</span></span>
            <span class="stat-desc">2% tax from packages and quantity.</span>
        </div>
    </div>

    <div class="text-center mt-4">
        <div class="flex flex-row">
            <div class="flex-1">
                <button type="button" class="btn btn-primary w-2/12 btn-sm"
                    onclick="document.getElementById('find_package').classList.add('modal-open')">Add Packages</button>
            </div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <div class="flex flex-row">
            <div class="flex-1">
                <div class="flex flex-row mb-2">
                    <div class="flex-1">
                        <div class="form-control mx-2">
                            <label class="label">Search</label>
                            <input type="search" name="package-sort" id="package-sort"
                                oninput="search(this, 'buffering-table')"
                                class="input input-primary input-sm input-bordered">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table w-full table-compact text-center" id="buffering-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Package Name</th>
                    <th>Package Type</th>
                    <th>Package Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody id="package-buffer">
                {{-- <tr>
					<th></th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr> --}}
            </tbody>
        </table>
    </div>

    <form action="/transaction" method="post" class="text-center">
        @csrf

        <div id="the-changeling">
            <input type="hidden" name="transaction_price" id="transaction_price" value="0">
            <input type="hidden" name="fee_price" id="fee_price" value="0">
            <input type="hidden" name="tax_price" id="tax_price" value="0">
        </div>

        <div id="package-information">

        </div>

        <div class="flex flex-row my-4">
            <div class="flex-1 mx-4 w-full">
                <div tabindex="0" class="collapse collapse-arrow">
                    <input type="checkbox">
                    <div class="collapse-title text-xl font-medium">
                        Customer Information
                    </div>
                    <div class="collapse-content">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Name</span>
                            </label>

                            <div class="input-group">
                                <input type="hidden" name="member_id" id="member_input_real" value="">
                                <input type="text" id="member_input" class="input input-bordered w-full" value="" readonly>
                                <button type="button" class="btn btn-primary"
                                    onclick="document.getElementById('find_member').classList.add('modal-open')">Find</button>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Address</span>
                            </label>

                            <div class="input-group">
                                <input type="text" id="address_input" class="input input-bordered w-full" value="" readonly>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Contact</span>
                            </label>

                            <div class="input-group">
                                <input type="text" id="phone_input" class="input input-bordered w-full" value="" readonly>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Gender</span>
                            </label>

                            <div class="input-group">
                                <input type="text" id="gender_input" class="input input-bordered w-full" value="" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-control my-4">
                    <label class="cursor-pointer label">
                        <span class="label-text">Toggle notes</span>
                        <input type="checkbox" class="toggle toggle-accent" onclick="toggle_note(this)">
                    </label>

                    <span class="text-justify text-sm opacity-50">Adding notes to the transaction will increase fee.</span>
                </div>

                <div class="form-control w-full hidden" id="note_textarea">
                    <label class="label">
                        <span class="label-text">Notes</span>
                    </label>

                    <textarea name="notes" class="textarea h-32 textarea-bordered" placeholder="Notes">NONE</textarea>
                </div>
            </div>

            <div class="flex-1 mx-4 w-full">
                <div tabindex="0" class="collapse collapse-arrow">
                    <input type="checkbox">
                    <div class="collapse-title text-xl font-medium">
                        Seller Information
                    </div>
                    <div class="collapse-content">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Transaction Type</span>
                            </label>

                            <div class="flex-row">
                                <select name="pay_type" id="pay_type" class="select select-bordered w-full"
                                    onchange="change_pay(this)" required>
                                    <option selected disabled>Choose the type of transaction</option>
                                    <option value="NOW">Pay Now</option>
                                    <option value="LATER">Pay Later</option>
                                </select>
                            </div>
                        </div>

                        <div id="pay-input" class="hidden">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Deadline Time</span>
                                </label>

                                <div class="flex-row">
                                    <input type="date" name="deadline_time" id="deadline_input"
                                        class="input input-bordered w-full" required>
                                </div>

                                <div class="flex-row mt-2">

                                </div>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Discount</span>
                                </label>

                                <div class="flex-row">
                                    <select name="discount" id="discount_input" class="select select-bordered w-full">
                                        <option value="0">No Discount</option>
                                        <option value="10">10% Discount</option>
                                        <option value="20">20% Discount</option>
                                        <option value="30">30% Discount</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-10">Transact</button>
    </form>
@endsection
