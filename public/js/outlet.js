document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('outlet-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('outlet-view').classList.contains('hidden')) {
            document.getElementById('outlet-view').classList.remove('hidden')
            document.getElementById('outlet-view-btn').classList.add('btn-active')
            document.getElementById('outlet-creation').classList.add('hidden')
            document.getElementById('outlet-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('outlet-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('outlet-creation').classList.contains('hidden')) {
            document.getElementById('outlet-creation').classList.remove('hidden')
            document.getElementById('outlet-creation-btn').classList.add('btn-active')
            document.getElementById('outlet-view').classList.add('hidden')
            document.getElementById('outlet-view-btn').classList.remove('btn-active')
        }
    })

})

function request_info(el, casual_input, real_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelector('th').innerHTML

    console.log(table_element)

    document.getElementById(modal).classList.add('modal-open')
    document.getElementById('outlet_id').value = id


    $.ajax({
        type: 'POST',
        url: '/get-outlet',
        data: { id: id },
        success: function (response) {
            console.log(response.response)

            document.getElementById(casual_input).value = response.outlet_name
            document.getElementById(real_input).value = response.outlet_id
            document.getElementById('phone_input_edit').value = response.outlet_phone
            document.getElementById('name_input_edit').value = response.outlet_name
            document.getElementById('address_input_edit').value = response.outlet_address
        }
    })
}