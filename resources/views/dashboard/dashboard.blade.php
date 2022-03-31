@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="m-6">
        <div class="flex flex-row border-2 border-primary p-4">
            <article class="flex-1">
                <div class="card w-full shadow-lg bg-slate-100 mt-6">
                    <div class="card-body">
                        <h3 class="card-title justify-between">
                            <span>March 28 - Important Reviews</span>
                            <span class="opacity-50 text-sm">{{ date('27-03-2022') }}</span>
                        </h3>
                        <p>Attention, dear employees! On March 28 of 2022, there will be an important review by our dear
                            fellow testers from several different regions in our country. Any following bugs must be
                            smoothed out before being pushed to our main branch. Thank you for your patronage!</p>
                    </div>
                </div>

                <div class="card w-full shadow-lg bg-slate-100 mt-6">
                    <div class="card-body">
                        <h3 class="card-title justify-between">
                            <span>March 21 - Review Training</span>
                            <span class="opacity-50 text-sm">{{ date('20-03-2022') }}</span>
                        </h3>
                        <p>Attention, dear employees! On March 21 of 2022, an important review testing will take place in
                            our meeting room with the same form as interview. This will be a necessity on our future, as we
                            may have a reviewer come to our corporation in the future.</p>
                    </div>
                </div>

                <div class="card w-full shadow-lg bg-slate-100 mt-6">
                    <div class="card-body">
                        <h3 class="card-title justify-between">
                            <span>March 18 - Security Breach</span>
                            <span class="opacity-50 text-sm">{{ date('18-03-2022') }}</span>
                        </h3>
                        <p>Attention, dear employees! We apologize for our greatest mistakes, but we have wrongly allowed
                            some suspicious individuals view the source code of our back-end server, and allowed a bypass to
                            be placed in our systems. We apologize for any downtime in our maintenance period.</p>
                    </div>
                </div>
            </article>

            <section class="flex-1 ml-4 text-center">
                {{-- <img src="{{ asset('images/dashboard.png') }}" class="h-[50%] w-[100%]"> --}}
                <div class="avatar items-center justify-center">
                    <div class="h-[50%] w-[50%] rounded-full border-2 border-black">
                        <img src="{{ Auth::user()->profile_picture != ''? asset('profiles/' . Auth::user()->profile_picture): asset('profiles/default.png') }}"
                            alt="Profile picture" class="h-[50%] w-[50%]    ">
                    </div>
                </div>

                <p class="text-xl mt-6">Welcome, <span class="font-bold">{{ Auth::user()->name }}</span> back
                    to
                    <span class="font-bold">{{ Auth::user()->outlets->outlet_name }}</span>!
                </p>
                <span class="opacity-50 mt-2">You were registered in {{ Auth::user()->created_at }}</span>
            </section>
        </div>
    </div>
@endsection
