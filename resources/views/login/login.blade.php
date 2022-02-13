@extends('preload.default')

@section('container')
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


<div class="hero min-h-screen bg-base-200">
    <div class="flex-col justify-center hero-content lg:flex-row px-2">
        <div class="text-center lg:text-left">
            <h1 class="mb-5 text-5xl font-bold">
                Windblade
            </h1>
            <p class="mb-5">
                Windblade is an laundromat franchise founded in 2007 with many different outlets stored within our
                corporation, with manageable prices and easy management tools.
            </p>
        </div>

        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="/login" method="post">
                    @csrf
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Username</span>
                        </label>
                        <input type="text" name="username" placeholder="username" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Password</span>
                        </label>
                        <input type="password" name="password" placeholder="password" class="input input-bordered">
                        <label class="label">
                            <a href="#" class="label-text-alt">Forgot password?</a>
                        </label>
                    </div>
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary"> Login </button>
                        <div class="form-control mt-4">
                            <a role="button" href="/register" class="text-sm text-center link-primary">Request
                                Registration</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection