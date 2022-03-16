@extends('preload.default')

@section('container')
    @include('partials.header')

    <div class="flex flex-row m-4">
        <div class="flex-1">
            <p class="font-bold text-xl">Worker Salary Simulation</p>
        </div>
    </div>

    <form id="salaryForm">
        <div class="border-2 border-black mx-4">
            <div class="flex flex-row">
                <div class="flex-1 mx-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Worker ID</span>
                        </label>

                        <div class="flex">
                            <input type="number" name="worker_id" id="idInput" min="1" value="1"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Gender</span>
                        </label>

                        <div class="flex-row">
                            <select name="gender" id="genderInput" class="select select-sm select-bordered w-full" required>
                                <option value="MALE">MALE</option>
                                <option value="FEMALE">FEMALE</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Children</span>
                        </label>

                        <div class="flex">
                            <input type="number" name="worker_id" id="childInput" min="0" value="0"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>
                </div>

                <div class="flex-1 mx-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Worker Name</span>
                        </label>

                        <div class="flex">
                            <input type="text" name="worker_name" id="nameInput"
                                class="input input-sm input-bordered w-full" required>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Marriage Status</span>
                        </label>

                        <div class="flex-row">
                            <select name="status" id="statusInput" class="select select-sm select-bordered w-full" required>
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Day of Work</span>
                        </label>

                        <div class="flex">
                            <input type="date" name="worker_date" id="dateInput"
                                class="date-input input-sm input-bordered w-full" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-row text-center">
                <div class="flex-1">
                    <button type="submit" class="btn btn-primary btn-sm my-2" id="submitBtn">Submit</button>
                </div>
            </div>
        </div>
    </form>

    <div class="flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <div class="flex flex-row">
                    <div class="flex-1">
                        <select id="sortInput" class="select select-sm select-bordered">
                            <option value="id" selected>ID</option>
                            <option value="childrens">CHILDRENS</option>
                            <option value="name">NAME</option>
                            <option value="totalSalary">TOTAL SALARY</option>
                            <option value="start">START OF WORK</option>
                        </select>
                        <button class="btn btn-info btn-sm m-2"
                            onclick="sort(get_id(), document.getElementById('sortInput').value)">Sort</button>
                    </div>

                    <div class="flex-none">
                        <div class="input-group">
                            <input type="search" name="search" id="searchInput" class="input input-bordered input-sm"
                                oninput="search(this, 'salary-table')">
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="search(document.getElementById('searchInput'), 'salary-table')">Search</button>
                        </div>
                    </div>
                </div>
                <table class="table w-full text-center" id="salary-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Status</th>
                            <th>Childrens</th>
                            <th>Start Work</th>
                            <th>Base Salary</th>
                            <th>Support Salary</th>
                            <th>Total Salary</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-center">TOTAL</td>
                            <td id="totalBaseSalary">0</td>
                            <td id="totalSupportSalary">0</td>
                            <td id="totalSalary">0</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
