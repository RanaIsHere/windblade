document.addEventListener('DOMContentLoaded', () => {
    $('#item-table').DataTable({
        info: false
    })

    document.getElementById('addDataBtn').addEventListener('click', function () {
        openModal('addModal')
    })
})

const notify = (message) => {
    const notification_group = document.getElementById('notification-group')
    let notification = document.createElement('div')
    notification.classList.add('card')
    notification.classList.add('w-80')
    notification.classList.add('bg-green-200')
    notification.classList.add('shadow-xl')
    notification.classList.add('mt-4')

    notification.innerHTML = `
    <div class="card-body">
        <div class="flex">
            <h2 class="card-title mx-2">` + message + `</h2>
            <button class="btn btn-primary btn-sm mx-2"
                onclick="this.parentElement.parentElement.parentElement.remove()">
                Close</button>
        </div>  
    </div>`

    notification_group.appendChild(notification)

    setTimeout(() => {
        notification.remmove()
    }, 3000)
}

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
        url: '/items/update-status',
        data: { id: id, item_status: status },
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
        url: '/items/edit',
        data: { id: id },
        success: function (response) {
            document.getElementById('idInput').value = response.id
            document.getElementById('dateTimeEditInput').value = new Date(response.paydate).toJSON().slice(0, 19)
            document.getElementById('statusEditInput').value = response.item_status
            document.getElementById('supplierEditInput').value = response.item_supplier
            document.getElementById('nameEditInput').value = response.item_name
            document.getElementById('quantityEditInput').value = response.item_quantity
            document.getElementById('priceEditInput').value = response.item_price

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
        url: '/items/delete',
        data: { id: id },
        success: function (response) {
            document.getElementById('deleteIdInput').value = response.id

            openModal('deleteModal')
        }
    })
}