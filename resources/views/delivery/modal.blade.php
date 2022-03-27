<div id="createDelivery" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Send a delivery with this one simple modal!</p>

        <form action="/delivery/create" method="post" id="createForm">
            @csrf

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member</span>
                        </label>

                        <div class="input-group">
                            <input type="hidden" name="member_id" id="memberCreateInput">
                            <input type=" text" id="member_name" class="input input-bordered w-full" readonly required>
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('pickMember').classList.add('modal-open'); document.getElementById('pickMember').getElementsByTagName('span')[0].innerText = 'CREATE'">Pick</button>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Address</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" id="member_address" class="input input-bordered w-full" readonly>
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Contact</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" id="member_contact" class="input input-bordered w-full" readonly>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Carrier Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="carrier" id="carrierCreateInput"
                                class="input input-bordered w-full" maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="status" id="statusCreateInput" class="select select-bordered w-full" required>
                                <option value="REGISTERED">REGISTERED</option>
                                <option value="DELIVERING">DELIVERING</option>
                                <option value="DONE">DONE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Add Delivery</button>
            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('createDelivery').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>

<div id="editDelivery" class="modal">
    <div class="modal-box min-w-full text-center">
        <p>Send a delivery with this one simple modal!</p>

        <form action="/delivery/edit" method="post" id="editForm">
            @csrf

            <input type="hidden" name="delivery_id" id="delivery_id">

            <div class="flex flex-row">
                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member</span>
                        </label>

                        <div class="input-group">
                            <input type="hidden" name="member_id" id="memberEditInput">
                            <input type=" \text" id="member_name_edit" class="input input-bordered w-full" readonly
                                required>
                            <button type="button" class="btn btn-primary"
                                onclick="document.getElementById('pickMember').classList.add('modal-open'); document.getElementById('pickMember').getElementsByTagName('span')[0].innerText = 'EDIT'">Pick</button>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Address</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" id="member_address_edit" class="input input-bordered w-full" readonly>
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Member Contact</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" id="member_contact_edit" class="input input-bordered w-full" readonly>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Carrier Name</span>
                        </label>

                        <div class="flex-row">
                            <input type="text" name="carrier" id="carrierEditInput" class="input input-bordered w-full"
                                maxlength="100" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="status" id="statusEditInput" class="select select-bordered w-full" required>
                                <option value="REGISTERED">REGISTERED</option>
                                <option value="DELIVERING">DELIVERING</option>
                                <option value="DONE">DONE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary my-10 mx-2">Edit Delivery</button>
            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('editDelivery').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>

<div id="deleteDelivery" class="modal">
    <div class="modal-box text-center">
        <form action="/delivery/delete" method="post" id="deleteForm">
            @csrf

            <input type="hidden" name="id" id="deleteId">

            <div class="flex flex-row">
                <div class="flex-1 mx-4">
                    <p>Are you sure you wish to delete this delivery?</p>
                </div>
            </div>

            <button type="submit" class="btn btn-danger my-10 mx-2">Delete Delivery</button>
            <button type="button" class="btn btn-primary my-10 mx-2"
                onclick="document.getElementById('deleteDelivery').classList.remove('modal-open')">Cancel</button>
        </form>
    </div>
</div>

<div id="importDelivery" class="modal">
    <div class="modal-box w-6/12 text-center">

        <form action="{{ route('import_delivery') }}" method="POST" enctype="multipart/form-data" id="importForm">
            @csrf

            <div class="form-control">
                <input type="file" name="file" id="file-import" class="m-4 input input-bordered" required>
            </div>

            <div class="modal-action">
                <button type="submit" class="btn btn-primary">Import</button>
                <button type="button" class="btn btn-primary"
                    onclick="this.parentElement.parentElement.parentElement.parentElement.classList.remove('modal-open')">Cancel</button>
            </div>
        </form>
    </div>
</div>


<div id="pickMember" class="modal">
    <span class="hidden"></span>

    <div class="modal-box min-w-full text-center">
        <p>Add available outlets to assign to this package for registration.</p>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member Name</th>
                        <th>Member Address</th>
                        <th>Member Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($memberData as $meme)
                        <tr>
                            <td>{{ $meme->id }}</td>
                            <td>{{ $meme->member_name }}</td>
                            <td>{{ $meme->member_address }}</td>
                            <td>{{ $meme->member_phone }}</td>
                            <th><button type="button" class="btn btn-primary"
                                    onclick="pickItem(this, document.getElementById('pickMember').getElementsByTagName('span')[0].innerText)">Pick</button>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal-action">
            <button type="button" class="btn btn-primary"
                onclick="document.getElementById('pickMember').classList.remove('modal-open')">Cancel</button>
        </div>
    </div>
</div>
