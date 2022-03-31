@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row bg-neutral-focus p-2 m-2 rounded-md text-neutral-content justify-between items-center">
        <div class="flex-1 ml-2 text-left">
            <p class="font-bold text-xl">{{ Auth::user()->name }}</p>
            <p class="font-light text-md opacity-70">{{ Auth::user()->username }}</p>
        </div>

        <div class="flex-1 mr-2 text-right">
            <p class="font-bold">Registered at</p>
            <p class="font-light opacity-60">{{ Auth::user()->created_at }}</p>
        </div>
    </div>

    <div class="flex flex-row p-2 m-2 rounded-md bg-stone-100 pb-10">
        <div class="flex-1 max-w-sm border-r-2 pr-2">
            <div class="avatar">
                <div class="min-w-fit rounded-full border-2 border-black">
                    <img src="{{ Auth::user()->profile_picture != ''? asset('profiles/' . Auth::user()->profile_picture): asset('profiles/default.png') }}"
                        alt="Profile picture" class="min-w-fit">
                </div>
            </div>

            <p class="font-semibold">Biodata</p>
            <p class="font-light text-md opacity-70" id="biodata">
                {{ Auth::user()->biodata }}
            </p>
        </div>

        <div class="flex-1 border-r-2 pr-2">
            <div class="overflow-y-scroll md:overflow-y-auto flex flex-col justify-center items-center">
                <div class="card w-[96%] bg-base-100 shadow-xl m-2">
                    <div class="card-body">
                        <h2 class="card-title">
                            Portfolio 1
                        </h2>
                        <p>University 1 </p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-primary badge-outline">Degree</div>
                            <div class="badge badge-primary badge-outline">Masters</div>
                        </div>
                    </div>
                </div>

                <div class="card w-[96%] bg-base-100 shadow-xl m-2">
                    <div class="card-body">
                        <h2 class="card-title">
                            Portfolio 2
                        </h2>
                        <p>University 2 </p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-primary badge-outline">Degree</div>
                            <div class="badge badge-primary badge-outline">Masters</div>
                        </div>
                    </div>
                </div>

                <div class="card w-[96%] bg-base-100 shadow-xl m-2">
                    <div class="card-body">
                        <h2 class="card-title">
                            Portfolio 3
                        </h2>
                        <p>University 3 </p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-primary badge-outline">Degree</div>
                            <div class="badge badge-primary badge-outline">Masters</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 border-r-2 pr-2">
            <div class="flex flex-col justify-center items-center">
                <div class="rounded-md pb-4 m-2 w-full">
                    <form action="{{ route('update_profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control p-2">
                            <label class="label">
                                <span class="label-text">Profile Picture</span>
                            </label>

                            <div class="input-group">
                                <input type="file" name="file" class="input input-bordered p-2" id="fileInput" hidden>
                                <input type="text" class="input input-bordered w-full p-2" id="fileNameInput" readonly>
                                <button type="button" class="btn btn-primary text-white" onclick="uploadBtn()">
                                    <i class="fa-solid fa-upload"></i>
                                    <p class="mx-2">Upload</p>
                                </button>
                            </div>
                        </div>

                        <div class="form-control p-2">
                            <label class="label">
                                <span class="label-text">Biodata</span>
                            </label>

                            <div class="flex-row">
                                <textarea name="biodata" id="biodataInput" class="textarea textarea-bordered w-full p-2"
                                    required>{{ Auth::user()->biodata }}</textarea>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary my-2 text-white">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
