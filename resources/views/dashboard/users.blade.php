@extends('preload.default')

@section('container')
@include('partials.header')
@include('partials.modals')

@if(Session::has('success'))
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

<div class="text-center">
    <button type="button" class="btn btn-primary my-5" onclick="document.getElementById('createUserModal').classList.add('modal-open')">Add User</button>
</div>

<div class="overflow-x-auto mx-4 border-primary-focus border-2">
    <table class="table w-full text-center">
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
                    <button class="btn btn-primary" onclick="request_info(this, 'user_id_modal', 'user_id_real_modal', 'editusers')">Edit</button>
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