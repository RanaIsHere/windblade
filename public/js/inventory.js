$('#inventory-table').DataTable();

document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('inventory-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('inventory-view').classList.contains('hidden')) {
            document.getElementById('inventory-view').classList.remove('hidden')
            document.getElementById('inventory-view-btn').classList.add('btn-active')
            document.getElementById('inventory-creation').classList.add('hidden')
            document.getElementById('inventory-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('inventory-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('inventory-creation').classList.contains('hidden')) {
            document.getElementById('inventory-creation').classList.remove('hidden')
            document.getElementById('inventory-creation-btn').classList.add('btn-active')
            document.getElementById('inventory-view').classList.add('hidden')
            document.getElementById('inventory-view-btn').classList.remove('btn-active')
        }
    })

})

function request_info(el, id_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelector('th').innerHTML

    document.getElementById(modal).classList.add('modal-open')

    $.ajax({
        type: 'POST',
        url: '/fetch-inventory',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id },
        success: function (response) {
            console.log(response)

            document.getElementById(id_input).value = response.response.id
            document.getElementById('name_input').value = response.response.product_name
            document.getElementById('brand_input').value = response.response.product_brand
            document.getElementById('quantity_input').value = response.response.quantity
            document.getElementById('type_input').value = response.response.condition
            document.getElementById('date_input').value = response.response.restock_date
        }
    })
}

function deleteItem(id_element, modal) {
    let id = document.getElementById(id_element).value

    document.getElementById(modal).classList.remove('modal-open')
    document.getElementById('deleteInventoryModal').classList.add('modal-open')

    document.getElementById('inventory_delete').value = id
}
