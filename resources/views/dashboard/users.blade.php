@extends('preload.default')

@section('container')

@include('partials.header')

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
                    <button class="btn btn-primary" onclick="request_info">Edit</button>
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