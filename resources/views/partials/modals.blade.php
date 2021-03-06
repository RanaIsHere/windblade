<div id="requestreg" class="modal">
    <div class="modal-box">
        <p>Are you sure that you want to request registration for an outlet? This will take up to several days through
            online channels, as an alternative, please visit our branch offices for quicker registration.</p>

        <form action="/request-registration" method="post">
            <div class="form-control py-4">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="text" placeholder="email" class="input input-bordered">
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Request</button>
                <button type="button" class="btn"
                    onclick="document.getElementById('requestreg').classList.remove('modal-open')">Cancel</button>
            </div>
        </form>
    </div>
</div>

@if ($page_name == 'Packages')
    <div id="addmembertopackage" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Add available outlets to assign to this package for registration.</p>

            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Outlet Name</th>
                            <th>Outlet Address</th>
                            <th>Outlet Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($outletData as $util)
                            <tr>
                                <th>{{ $util->id }}</th>
                                <td>{{ $util->outlet_name }}</td>
                                <td>{{ $util->outlet_address }}</td>
                                <td>{{ $util->outlet_phone }}</td>
                                <th><button type="button" class="btn btn-primary"
                                        onclick="getNameAndId(this, 0, 'outlet_input', 'outlet_input_real', 'addmembertopackage')">Pick</button>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('addmembertopackage').classList.remove('modal-open')">Cancel</button>
            </div>
        </div>
    </div>
@endif

<div id="deleteModal" class="modal">
    <div class="modal-box">
        <p class="font-bold">Are you sure that you wish to delete this item permanently?</p>

        <form action="/delete-item" method="post">
            @csrf

            <input type="hidden" name="delete_id" id="delete_id">
            <input type="hidden" name="model_type" id="model_type">

            <div class="modal-action my-4">
                <button type="submit"
                    class="btn btn-ghost bg-red-500 outline-red-500 hover:bg-red-700 hover:outline-red-700">Delete</button>
                <button type="button" class="btn btn-primary"
                    onclick="document.getElementById('deleteModal').classList.remove('modal-open')">Cancel</button>
            </div>
        </form>
    </div>
</div>

@if ($page_name == 'Packages')
    <div id="editpackages" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this package</p>

            <form action="/edit-package" method="post">
                @csrf

                <input type="hidden" name="package_id" id="package_id">

                <div class="flex flex-row">
                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Outlet ID</span>
                            </label>

                            <div class="input-group">
                                <input type="hidden" name="outlet_id" id="outlet_input_real_modal">
                                <input type="text" id="outlet_input_modal" class="input input-bordered w-full" readonly>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Package Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="package_name" id="name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Package Type</span>
                            </label>

                            <div class="flex-row">
                                <select name="package_type" id="type_input_edit" class="select select-bordered w-full">
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
                                <input type="number" name="package_price" id="price_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary my-10 mx-2">Edit Package</button>

                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('editpackages').classList.remove('modal-open')">Cancel</button>

                <button type="button"
                    class="btn btn-ghost bg-red-500 hover:bg-red-700 outline-red-500 hover:outline-red-700 my-10 mx-2"
                    onclick="deleteItem('package_id', 'packages', 'editpackages')">Delete</button>
            </form>
        </div>
    </div>
@endif

@if ($page_name == 'Outlets')
    <div id="editoutlets" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this outlet</p>

            <form action="/edit-outlet" method="post">
                @csrf

                <input type="hidden" name="outlet_id" id="outlet_id">

                <div class="flex flex-row">
                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Outlet ID</span>
                            </label>

                            <div class="input-group">
                                <input type="hidden" name="outlet_id" id="outlet_input_real_modal">
                                <input type="text" id="outlet_input_modal" class="input input-bordered w-full" readonly>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Business Status</span>
                            </label>

                            <div class="flex-row">
                                <select name="status" id="type_input_edit" class="select select-bordered w-full">
                                    <option value="ACTIVE">Active</option>
                                    <option value="CLOSED">Closed</option>
                                    <option value="BANKRUPT">Bankrupt</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Outlet Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="outlet_name" id="name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Outlet Address</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="outlet_address" id="address_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Outlet Phone Number</span>
                            </label>

                            <div class="input-group">
                                <span>+62</span>
                                <input type="text" name="outlet_phone" id="phone_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary my-10 mx-2">Edit Outlet</button>

                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('editoutlets').classList.remove('modal-open')">Cancel</button>


                <button type="button"
                    class="btn btn-ghost bg-red-500 hover:bg-red-700 outline-red-500 hover:outline-red-700 my-10 mx-2"
                    onclick="deleteItem('outlet_input_real_modal', 'outlets', 'editoutlets')">Delete</button>
            </form>
        </div>
    </div>
@endif

@if ($page_name == 'Customers')
    <div id="editcustomers" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this customer</p>

            <form action="/edit-customer" method="post">
                @csrf

                <input type="hidden" name="member_id" id="member_id">

                <div class="flex flex-row">
                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Member</span>
                            </label>

                            <div class="input-group">
                                <input type="hidden" name="outlet_id" id="outlet_input_real_modal">
                                <input type="text" id="outlet_input_modal" class="input input-bordered w-full" readonly>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Gender</span>
                            </label>

                            <div class="flex-row">
                                <select name="member_gender" id="type_input_edit" class="select select-bordered w-full">
                                    <option value="MALE">Male</option>
                                    <option value="FEMALE">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="member_name" id="name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Address</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="member_address" id="address_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Customer Phone Number</span>
                            </label>

                            <div class="input-group">
                                <span>+62</span>
                                <input type="text" name="member_phone" id="phone_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary my-10 mx-2">Edit Customer</button>

                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('editcustomers').classList.remove('modal-open')">Cancel</button>

                <button type="button"
                    class="btn btn-ghost bg-red-500 hover:bg-red-700 outline-red-500 hover:outline-red-700 my-10 mx-2"
                    onclick="deleteItem('outlet_input_real_modal', 'members', 'editcustomers')">Delete</button>
            </form>
        </div>
    </div>
@endif

@if ($page_name == 'Users')
    <div id="editusers" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this user</p>

            <form action="/edit-user" method="post">
                @csrf

                <input type="hidden" name="user_id" id="user_id">

                <div class="flex flex-row">
                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Current Full Name</span>
                            </label>

                            <div class="input-group">
                                <input type="hidden" name="user_id" id="user_id_real_modal">
                                <input type="text" id="user_id_modal" class="input input-bordered w-full" readonly>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Roles</span>
                            </label>

                            <div class="flex-row">
                                <select name="roles" id="role_input_edit" class="select select-bordered w-full">
                                    <option value="OWNER">Owner</option>
                                    <option value="ADMIN">Admin</option>
                                    <option value="CASHIER">Cashier</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Full Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="name" id="full_name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="username" id="name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary my-10 mx-2">Edit Customer</button>

                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('editusers').classList.remove('modal-open')">Cancel</button>

                <button type="button"
                    class="btn btn-ghost bg-red-500 hover:bg-red-700 outline-red-500 hover:outline-red-700 my-10 mx-2"
                    onclick="deleteItem('user_id_real_modal', 'users', 'editusers')">Delete</button>
            </form>
        </div>
    </div>
@endif

@if ($page_name == 'Users')
    <div id="createUserModal" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this user</p>

            <form action="/register-user" method="post">
                @csrf

                <input type="hidden" name="user_id" id="user_id">

                <div class="flex flex-row">
                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Roles</span>
                            </label>

                            <div class="flex-row">
                                <select name="roles" id="role_input_edit" class="select select-bordered w-full">
                                    <option value="OWNER">Owner</option>
                                    <option value="ADMIN">Admin</option>
                                    <option value="CASHIER">Cashier</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Full Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="name" id="full_name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Username</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="username" id="name_input_edit"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Password</span>
                            </label>

                            <div class="flex-row">
                                <input type="password" name="password" id="password_input_edit"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary my-10 mx-2">Add User</button>

                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('createUserModal').classList.remove('modal-open')">Cancel</button>
            </form>
        </div>
    </div>
@endif

@if ($page_name == 'Inventory')
    <div id="updateInventoryModal" class="modal">
        <div class="modal-box min-w-full text-center">
            <p>Change information related to this product inventory</p>

            <form action="/update-inventory" method="post">
                @csrf

                <input type="hidden" name="inventory_id" id="inventory_input">

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
                                <input type="date" name="restock_date" id="date_input"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1 mx-4 w-full">
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Product Name</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="product_name" id="name_input"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Product Brand</span>
                            </label>

                            <div class="flex-row">
                                <input type="text" name="product_brand" id="brand_input"
                                    class="input input-bordered w-full" maxlength="100" required>
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Quantity</span>
                            </label>

                            <div class="input-group">
                                <input type="number" name="quantity" id="quantity_input"
                                    class="input input-bordered w-full" required>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary my-10">Update</button>
                <button type="button" class="btn btn-primary my-10 mx-2"
                    onclick="document.getElementById('updateInventoryModal').classList.remove('modal-open')">Cancel</button>
                <button type="button"
                    class="btn btn-ghost bg-red-500 hover:bg-red-700 outline-red-500 hover:outline-red-700 my-10 mx-2"
                    onclick="deleteItem('inventory_input', 'updateInventoryModal')">Delete</button>
            </form>
        </div>
    </div>

    <div id="deleteInventoryModal" class="modal">
        <div class="modal-box">
            <p class="font-bold">Are you sure that you wish to delete this item permanently?</p>

            <form action="/delete-inventory" method="post">
                @csrf

                <input type="hidden" name="inventory_delete" id="inventory_delete">

                <div class="modal-action my-4">
                    <button type="submit"
                        class="btn btn-ghost bg-red-500 outline-red-500 hover:bg-red-700 hover:outline-red-700">Delete</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('deleteInventoryModal').classList.remove('modal-open')">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endif
