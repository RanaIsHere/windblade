<div id="editModal" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Edit existing items</p>

        <form action="/items/update" method="post">
            @csrf

            <input type="hidden" name="id" id="idInput">

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Paydate</span>
                        </label>

                        <div class="input-group">
                            <input type="datetime-local" name="paydate" class="date-input input-bordered w-full"
                                id="dateTimeEditInput" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="item_status" id="statusEditInput" class="select select-bordered w-full">
                                <option value="ORDERED">ORDERED</option>
                                <option value="SOLD">SOLD</option>
                                <option value="AVAILABLE">AVAILABLE</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Supplier Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="item_supplier" id="supplierEditInput"
                                class="input input-bordered w-full" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="item_name" id="nameEditInput" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Quantity</span>
                        </label>

                        <div class="flex-row">
                            <input type="number" name="item_quantity" id="quantityEditInput"
                                class="input input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Price</span>
                        </label>

                        <div class="input-group">
                            <span>Rp. </span>
                            <input type="number" name="item_price" id="priceEditInput"
                                class="input input-bordered w-full" required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Edit Item</button>

            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('editModal').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>
