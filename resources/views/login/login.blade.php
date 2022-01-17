@extends('preload.default')

@section('container')
@include('partials.modals')

<div class="hero min-h-screen bg-base-200">
    <div class="flex-col justify-center hero-content lg:flex-row px-2">
        <div class="text-center lg:text-left">
            <h1 class="mb-5 text-5xl font-bold">
                Windblade
            </h1>
            <p class="mb-5">
                Windblade is an laundromat franchise founded in 2007 with many different outlets stored within our corporation, with manageable prices and easy management tools.
            </p>
        </div>

        <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <div class="card-body">
                <form action="/dashboard" {{-- method="post" --}}>
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
                        <div class="form-control mt-2">
                            <button class="text-sm text-center link-primary" id="requestRegistration">Request Registration</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection