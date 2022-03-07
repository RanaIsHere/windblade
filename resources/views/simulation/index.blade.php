@extends('preload.default')

@section('container')
    @include('partials.header')

    <div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box m-4">
        <input type="checkbox">
        <div class="collapse-title text-xl font-medium text-right">
            Add item
        </div>
        <div class="collapse-content">
            <div class="flex flex-row">
                <div class="flex-1 p-2 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Gender</span>
                        </label>

                        <div class="flex-row">
                            <select name="gender" id="genderInput" class="select select-bordered w-full">
                                <option disabled selected>Pick a gender</option>
                                <option value="MALE">Male</option>
                                <option value="FEMALE">Female</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex-1 p-2 w-full">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">ID</span>
                        </label>

                        <div class="input-group">
                            <input type="number" name="id" id="idInput" class="input input-bordered w-full" min="1"
                                value="1" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>

                        <div class="input-group">
                            <input type="text" name="name" id="nameInput" class="input input-bordered w-full" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-row text-center my-5">
                <div class="flex-1">
                    <button type="button" class="btn btn-primary" onclick="submit_simulation()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row text-center">
        <div class="flex-1">
            <button class="btn btn-primary">Sort</button>
        </div>
    </div>

    <div class="flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <table class="table w-full text-center" id="simulation-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Gender</th>
                        </tr>
                    </thead>

                    <tbody id="simulation-table-tbody">
                        <tr>
                            <td>1</td>
                            <td>Oliver Man</td>
                            <td>MALE</td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Onion Woman</td>
                            <td>FEMALE</td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Orange Man</td>
                            <td>MALE</td>
                        </tr>

                        <tr>
                            <td>10</td>
                            <td>Apple Woman</td>
                            <td>FEMALE</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
