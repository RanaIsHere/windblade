@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row">
        <div class="flex-1 p-4">
            <div class="tabs mx-auto justify-center">
                <a id="report-tab" class="tab tab-lg tab-bordered tab-active text-opacity-100" onclick="change_tab(this)">
                    Reports
                </a>

                <a id="schedule-tab" class="tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Schedule
                </a>

                <a id="request-tab" class="indicator tab tab-lg tab-bordered" onclick="change_tab(this)">
                    Requests
                    <span id="request-counter" class="indicator-item badge hidden">0</span>
                </a>
            </div>
        </div>
    </div>

    <div id="reports-view" class="">
        <div class="flex flex-row">
            <div class="flex-1 p-4">
                <div class="overflow-x-auto">
                    <table class="table table-row-group w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactionData as $trd)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>Cy Ganderton</td>
                                    <td>Quality Control Specialist</td>
                                    <td>Blue</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex-1">

            </div>
        </div>
    </div>

    <div id="schedule-view" class="hidden">
        <div class="flex flex-row">
            <div class="flex-1 p-4">

            </div>
        </div>
    </div>

    <div id="requests-view" class="hidden">
        <div class="flex flex-row">
            <div class="flex-1 p-4">

            </div>
        </div>
    </div>
@endsection
