@extends('preload.default')

@section('container')
    @include('partials.modals')
    @include('partials.header')

    <div id="package-view" class="">
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Code</th>
                        <th>Package Name</th>
                        <th>Package Type</th>
                        <th>Package Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
    
                <tbody>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <th><button type="button" class="btn btn-primary"">View</button>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div
@endsection