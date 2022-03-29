@extends('preload.default')

@section('container')
    @include('delivery.modal')
    @include('partials.header')

    @if (Session::has('success'))
        <div class="alert alert-success">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                </svg>
                <label>{{ Session::get('success') }}</label>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if (Session::has('failure'))
        <div class="alert shadow-lg alert-error">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>{{ Session::get('failure') }}</span>
            </div>

            <button class="btn bg-transparent hover:bg-transparent" onclick="this.parentElement.remove()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block w-6 h-6 mr-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif


    <div class="flex flex-row">
        <div class="flex-1 m-4">
            <p class="font-bold text-xl">Laundry Delivery</p>
        </div>
    </div>

    <div class="flex flex-row">
        <div class="flex-1 my-2">
            <button class="btn btn-primary btn-sm mx-4"
                onclick="document.getElementById('createDelivery').classList.add('modal-open')">Add Data</button>
            <a href="/delivery/export" class="btn btn-info btn-sm mx-4">Export</a>
            <button class="btn btn-warning btn-sm mx-4"
                onclick="document.getElementById('importDelivery').classList.add('modal-open')">Import</button>
        </div>
    </div>

    <div class="flex flex-row">
        <div class="flex-1">
            <div class="overflow-x-auto p-2">
                <table class="table w-full table-compact py-2 text-center" id="delivery-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer Name</th>
                            <th>Customer Address</th>
                            <th>Customer Phone Number</th>
                            <th>Delivery Carrier</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($deliveryData as $dell)
                            <tr>
                                <td>
                                    <span>{{ $loop->iteration }}</span>
                                    <span class="hidden">{{ $dell->id }}</span>
                                    <span class="hidden">{{ $dell->member_id }}</span>
                                </td>
                                <td>{{ $dell->members->member_name }}</td>
                                <td>{{ $dell->members->member_address }}</td>
                                <td>{{ $dell->members->member_phone }}</td>
                                <td>{{ $dell->carrier }}</td>
                                <td>
                                    <select class="select select-bordered statusSelect" value="{{ $dell->status }}"
                                        onchange="changeStatus(this)">
                                        <option value="REGISTERED" @if ($dell->status == 'REGISTERED') selected @endif>
                                            REGISTERED</option>
                                        <option value="DELIVERING" @if ($dell->status == 'DELIVERING') selected @endif>
                                            DELIVERING</option>
                                        <option value="DONE" @if ($dell->status == 'DONE') selected @endif>DONE
                                        </option>
                                    </select>
                                </td>

                                <td>
                                    <button class="btn btn-info btn-sm" onclick="edit(this)">Edit</button>
                                    <button class="btn btn-error btn-sm" onclick="deleteItem(this)">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('partials.notifications')
@endsection

@push('deliveries')
    <script>
        $('#delivery-table').DataTable({
            info: false,
        })

        // Set suatu input di dalam modal delete untuk bisa di panggil formnya.
        function deleteItem(entity) {
            const parent = entity.parentElement.parentElement
            const id = parent.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText

            document.getElementById('deleteDelivery').classList.add('modal-open')
            document.getElementById('deleteId').value = Number(id)
        }

        // Memanggil AJAX untuk menggantikan kolom status di tabel.
        function changeStatus(entity) {
            const parent = entity.parentElement.parentElement
            const id = parent.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText
            const status = entity.value

            $.ajax({
                url: '/delivery/status',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    // Mencari dimana adanya selected dihapuskan, dan adakan pada option dengan value yang sama.
                    for (i = 0; i < entity.children.length; i++) {
                        if (entity.getElementsByTagName('option')[i].getAttribute('selected')) {
                            entity.getElementsByTagName('option')[i].removeAttribute('selected')
                        }

                        if (entity.getElementsByTagName('option')[i].value == String(response.response
                                .status)) {
                            entity.value = response.response.status
                            entity.getElementsByTagName('option')[i].setAttribute('selected', 'selected')
                        }
                    }

                    notify('Status successfully changed!')
                }
            })

        }


        // Set banyak input di dalam modal edit untuk bisa di panggil formnya.

        function edit(entity) {
            entity.classList.add('loading')

            const parent = entity.parentElement.parentElement
            const id = parent.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText
            const name = parent.getElementsByTagName('td')[1].innerText
            const address = parent.getElementsByTagName('td')[2].innerText
            const contact = parent.getElementsByTagName('td')[3].innerText

            $.ajax({
                url: '/delivery/fetch_edit',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id
                },
                success: function(response) {
                    entity.classList.remove('loading')
                    document.getElementById('editDelivery').classList.add('modal-open')

                    document.getElementById('delivery_id').value = response.response.id
                    document.getElementById('memberEditInput').value = response.response.member_id
                    document.getElementById('carrierEditInput').value = response.response.carrier
                    document.getElementById('statusEditInput').value = response.response.status

                    document.getElementById('member_name_edit').value = name
                    document.getElementById('member_address_edit').value = address
                    document.getElementById('member_contact_edit').value = contact
                }
            })
        }

        // Memilih member pada saat creating/editing di input yang sudah tertentu untuk member_id.

        function pickItem(entity, type) {
            const parent = entity.parentElement.parentElement
            const id = parent.getElementsByTagName('td')[0].innerText
            const name = parent.getElementsByTagName('td')[1].innerText
            const address = parent.getElementsByTagName('td')[2].innerText
            const contact = parent.getElementsByTagName('td')[3].innerText

            if (type == 'CREATE') {
                document.getElementById('memberCreateInput').value = id
                document.getElementById('member_name').value = name
                document.getElementById('member_address').value = address
                document.getElementById('member_contact').value = contact
            } else {
                document.getElementById('memberEditInput').value = id
                document.getElementById('member_name_edit').value = name
                document.getElementById('member_address_edit').value = address
                document.getElementById('member_contact_edit').value = contact
            }

            document.getElementById('pickMember').classList.remove('modal-open')
        }
    </script>
@endpush
