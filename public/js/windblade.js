$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

document.addEventListener('DOMContentLoaded', function (e) {
    document.getElementById('requestRegistration').addEventListener('click', function (e) {
        e.preventDefault()

        document.getElementById('requestreg').classList.add('modal-open')
    })
})

// Modular Functions

/*
    This function gets the placement of th and td within <tr>
    then places it within two specific input, and to close the modal.
*/
function getNameAndId(el, placement, casual_input, real_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelector('th').innerHTML
    let name = table_element.querySelectorAll('td')[placement].innerHTML

    console.log(table_element)

    document.getElementById(casual_input).value = name
    document.getElementById(real_input).value = id
    document.getElementById(modal).classList.remove('modal-open')
}

/*
    This function deletes the item mentioned by the id_element within the modal, and
    specified with the delete button of the current model type.
*/

function deleteItem(id_element, model_type, modal) {
    let id = document.getElementById(id_element).value

    document.getElementById(modal).classList.remove('modal-open')
    document.getElementById('deleteModal').classList.add('modal-open')

    document.getElementById('delete_id').value = id
    document.getElementById('model_type').value = model_type
}