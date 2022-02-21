@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <div class="tabs mx-auto justify-center">
                <a id="report-tab" class="tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Reports
                </a>

                <a id="schedule-tab" class="tab tab-lg tab-bordered tab-active text-opacity-100" onclick="change_tab(this)">
                    Schedule
                </a>

                <a id="request-tab" class="indicator tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Requests
                    <span id="request-counter" class="indicator-item badge hidden">0</span>
                </a>
            </div>
        </div>
    </div>
@endsection
