document.addEventListener('DOMContentLoaded', () => {
    $('#usage-table').DataTable({
        info: false,
        searching: false,
        lengthChange: false,

        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdf',
                exportOptions: {
                    columns: ':visible:not(:last-child)'
                }
            }
        ]
    })

    document.getElementById('searchForm').addEventListener('submit', function (e) {
        e.preventDefault()

        search(document.getElementById('searchInput'), 'usage-table')
    })
})

const openModal = (modal) => {
    document.getElementById(modal).classList.add('modal-open')
}

const closeModal = (modal) => {
    document.getElementById(modal).classList.remove('modal-open')
}

const updateStatus = (entity) => {
    const row = entity.parentElement.parentElement
    const id = row.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText
    const status = entity.value

    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/data-usage/status',
        data: { id: id, status: status },
        success: function (response) {
            notify(response.success)
        }
    })
}

const updateRow = (entity) => {
    const row = entity.parentElement.parentElement
    const id = row.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText

    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/data-usage/fetch-edit',
        data: { id: id },
        success: function (response) {
            document.getElementById('idInput').value = response.id
            document.getElementById('itemEditInput').value = response.nama_barang
            document.getElementById('statusEditInput').value = response.status
            document.getElementById('userEditInput').value = response.nama_pemakai
            document.getElementById('pakaiEditInput').value = new Date(response.waktu_pakai).toJSON().slice(0, 19)
            document.getElementById('beresEditInput').value = new Date(response.waktu_beres).toJSON().slice(0, 19)

            openModal('editModal')
        }
    })
}

const deleteRow = (entity) => {
    const row = entity.parentElement.parentElement
    const id = row.getElementsByTagName('td')[0].getElementsByTagName('span')[1].innerText

    $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/data-usage/fetch-delete',
        data: { id: id },
        success: function (response) {
            document.getElementById('deleteIdInput').value = response.id

            openModal('deleteModal')
        }
    })
}