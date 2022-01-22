@extends('preload.default')

@section('container')

@include('partials.header')

<div class="text-center my-10">   
    <div class="btn-group inline-block">
        <button class="btn btn-outline btn-active w-32" id="customer-view-btn">View</button>
        <button class="btn btn-outline w-32" id="customer-creation-btn">Create</button>
    </div>
</div>

<div id="customer-view" class="">
    <div class="overflow-x-auto">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer Name</th>
                    <th>Customer Address</th>
                    <th>Customer Contact</th>
                    <th>Customer Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($customerData as $member)                    
                    <tr>
                        <th>{{ $member->id }}</th>
                        <td>{{ $member->member_name }}</td>
                        <td>{{ $member->member_address }}</td>
                        <td>{{ $member->member_phone }}</td>
                        <td>{{ $member->member_gender }}</td>
                        <th><button type="button" class="btn btn-primary">Edit</button></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="customer-creation" class="hidden">
    <form action="/customer" method="post" class="text-center">
        @csrf
        <div class="flex flex-row">
            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Gender</span>
                    </label>

                    <div class="flex-row">
                        <select name="member_gender" id="type_input" class="select select-lg select-bordered w-full">
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex-1 mx-4 w-full">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Member Name</span>
                    </label>

                    <div class="flex-row">
                        <input type="text" name="member_name" id="name_input" class="input input-bordered w-full"
                            maxlength="100" required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Member Address</span>
                    </label>

                    <div class="flex-row">
                        <input type="text" name="member_address" id="address_input" class="input input-bordered w-full" required>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Member Phone Number</span>
                    </label>

                    <div class="input-group">
                        <span>+62</span>
                        <input type="text" name="member_phone" id="contact_input" class="input input-bordered w-full" required>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary my-10">Create Member</button>
    </form>
</div>
@endsection