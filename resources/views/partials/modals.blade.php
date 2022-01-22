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
                        <th><button type="button" class="btn btn-primary" onclick="getNameAndId(this, 0, 'outlet_input', 'outlet_input_real', 'addmembertopackage')">Pick</button></th>
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