document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('customer-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('customer-view').classList.contains('hidden')) {
            document.getElementById('customer-view').classList.remove('hidden')
            document.getElementById('customer-view-btn').classList.add('btn-active')
            document.getElementById('customer-creation').classList.add('hidden')
            document.getElementById('customer-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('customer-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('customer-creation').classList.contains('hidden')) {
            document.getElementById('customer-creation').classList.remove('hidden')
            document.getElementById('customer-creation-btn').classList.add('btn-active')
            document.getElementById('customer-view').classList.add('hidden')
            document.getElementById('customer-view-btn').classList.remove('btn-active')
        }
    })

})

function request_info(el, casual_input, real_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelector('th').innerHTML

    console.log(table_element)

    document.getElementById(modal).classList.add('modal-open')
    document.getElementById('member_id').value = id


    $.ajax({
        type: 'POST',
        url: '/get-customer',
        data: { id: id },
        success: function (response) {
            console.log(response.response)

            let phone_number = response.response.member_phone

            document.getElementById(real_input).value = response.response.id
            document.getElementById(casual_input).value = response.response.member_name
            document.getElementById('name_input_edit').value = response.response.member_name
            document.getElementById('address_input_edit').value = response.response.member_address
            document.getElementById('phone_input_edit').value = phone_number.slice(2)
            document.getElementById('type_input_edit').value = response.response.member_gender
        }
    })
}