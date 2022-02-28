@extends('preload.default')

@section('container')
    @include('partials.header')
    @include('partials.modals')

    @if (Session::has('success'))
        <div class="alert alert-success" id="alert-div">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <label>{{ Session::get('success') }}</label>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="document.getElementById('alert-div').remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert shadow-lg alert-error">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>
                    @foreach ($errors->all() as $errors)
                        {{ $errors }}
                    @endforeach
                </span>
            </div>
        </div>
    @endif

    <div class="text-center">
        <button type="button" class="btn btn-primary my-5"
            onclick="document.getElementById('createUserModal').classList.add('modal-open')">Add User</button>
    </div>

    <div class="overflow-x-auto mx-4 border-primary-focus border-2">
        <div class="flex flex-row">
            <div class="flex-1">
                <div class="flex flex-row mb-2">
                    <div class="flex-1">
                        <div class="form-control mx-2">
                            <label class="label">Search</label>
                            <input type="search" name="package-sort" id="package-sort" oninput="search(this, 'user-table')"
                                class="input input-primary input-bordered">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table w-full text-center" id="user-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Assigned Outlet</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userData as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>

                        <td>
                            <div>
                                <div class="font-bold">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </td>
                        <td>
                            {{ $user->username }}

                            <br>
                            <span class="badge badge-outline badge-sm">{{ $user->roles }}</span>
                        </td>
                        <td>{{ $user->outlets->outlet_name }}</td>
                        <th>
                            <button class="btn btn-primary"
                                onclick="request_info(this, 'user_id_modal', 'user_id_real_modal', 'editusers')">Edit</button>
                        </th>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Assigned Outlet</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
