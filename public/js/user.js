function request_info(el, casual_input, real_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelectorAll('td')[0].innerHTML

    console.log(id)

    document.getElementById(modal).classList.add('modal-open')
    document.getElementById('user_id').value = id

    $.ajax({
        type: 'POST',
        url: '/get-user',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { id: id },
        success: function (response) {
            document.getElementById(casual_input).value = response.response.name
            document.getElementById(real_input).value = response.response.id
            document.getElementById('role_input_edit').value = response.response.roles
            document.getElementById('full_name_input_edit').value = response.response.name
            document.getElementById('name_input_edit').value = response.response.username
        }
    })
}