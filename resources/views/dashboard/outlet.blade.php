@extends('preload.default')

@section('container')
    @include('partials.modals')

    @include('partials.header')

    @if (Session::has('success'))
        <div class="alert alert-success non-printable" id="alert-div">
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
        <div class="alert shadow-lg alert-error non-printable">
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

    <div class="text-center my-10 non-printable">
        <div class="inline-block">
            <p class="text-xl font-bold">OUTLET MANAGEMENT</p>
        </div>

        <div class="my-2">
            <button class="btn btn-primary btn-sm" onclick="window.print()">Print</button>
        </div>
    </div>

    <div id="outlet-view" class="">
        @foreach ($outletData as $util)
            <div class="card lg:card-side card-bordered text-center bg-base-200 rounded-box mx-10">
                <div class="card-body">
                    <div class="my-10">
                        <h2 class="text-sm font-bold">STATUS</h2>
                        <h2 class="text-xl font-bold">{{ $util->status }}</h2>
                    </div>

                    <div class="flex">
                        <div class="flex-1">
                            <h2 class="text-sm font-bold">NAME</h2>
                            <p class="text-xl font-bold"> {{ $util->outlet_name }} </p>
                            <p class="font-sm opacity-50 non-printable" id="table_outlet_id">{{ $util->id }}</p>
                        </div>

                        <div class="flex-1">
                            <h2 class="text-sm font-bold">ADDRESS</h2>
                            <p class="font-bold text-xl">"{{ $util->outlet_address }}"</p>
                            <p class="text-sm">+{{ $util->outlet_phone }}</p>
                        </div>
                    </div>

                    <div class="my-10">
                        <h2 class="text-sm font-bold">REGISTERED USERS</h2>
                        <h2 class="text-xl font-bold">{{ $util->user->count() }}</h2>
                    </div>

                    <div class="card-actions inline-block non-printable">
                        <button type="button" class="btn btn-primary"
                            onclick="request_info(this, 'outlet_input_modal', 'outlet_input_real_modal', 'editoutlets')">Edit</button>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
