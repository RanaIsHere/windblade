@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="m-6">
        <p class="text-xl">Welcome, <span class="font-bold">{{ Auth::user()->name }}</span>!</p>
    </div>
@endsection