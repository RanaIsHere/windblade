<div id="addModal" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Add items to modal</p>

        <form action="/items/create" method="post">
            @csrf

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Paydate</span>
                        </label>

                        <div class="input-group">
                            <input type="datetime-local" name="paydate" class="date-input input-bordered w-full"
                                id="dateTimeInput" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="item_status" id="statusInput" class="select select-bordered w-full">
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
                            <input type="text" name="item_supplier" id="supplierInput"
                                class="input input-bordered w-full" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="item_name" id="nameInput" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Quantity</span>
                        </label>

                        <div class="flex-row">
                            <input type="number" name="item_quantity" id="quantityInput"
                                class="input input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Item Price</span>
                        </label>

                        <div class="input-group">
                            <span>Rp. </span>
                            <input type="number" name="item_price" id="priceInput" class="input input-bordered w-full"
                                required>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Create Item</button>

            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('addModal').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>
