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
    let id = document.getElementById('table_outlet_id').innerText

    document.getElementById(modal).classList.add('modal-open')
    document.getElementById('outlet_id').value = id


    $.ajax({
        type: 'POST',
        url: '/get-outlet',
        data: { id: id },
        success: function (response) {
            console.log(response.response)

            let phone_number = response.response.outlet_phone

            document.getElementById(real_input).value = response.response.id
            document.getElementById(casual_input).value = response.response.outlet_name
            document.getElementById('name_input_edit').value = response.response.outlet_name
            document.getElementById('address_input_edit').value = response.response.outlet_address
            document.getElementById('phone_input_edit').value = phone_number.slice(2)
            document.getElementById('type_input_edit').value = response.response.status
        }
    })
}