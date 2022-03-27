$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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

/*
    This function filters the table by the search value through onInput within the search input attribute, and
    inputting the name of the current table through the parameter. This function is fully modular, as long as there are
    tbody within the table.
*/

function search(search, table) {
    let record, success
    let search_value = search.value.toUpperCase()
    let table_element = document.getElementById(table)
    let rows = table_element.querySelector('tbody').getElementsByTagName('tr')

    for (i = 0; i < rows.length; i++) {
        record = rows[i].getElementsByTagName('td')

        for (j = 0; j < record.length; j++) {
            if (record[j].innerText.toUpperCase().indexOf(search_value) > -1) {
                success = true
            }
        }

        if (success) {
            rows[i].classList.remove('hidden')
            success = false
        } else {
            rows[i].classList.add('hidden')
        }
    }
}

/*
    Used to filter dictionary as the indexOf function from native Javascript only works with Arrays.
*/

function get_index(dictionary, indexed_filter, filter) {
    if (dictionary.length <= 0) {
        return false
    }

    for (i = 0; i < dictionary.length; i++) {
        if (dictionary[i][indexed_filter] == filter) {
            return i
        }
    }
}

function sift_table(table, filter) {
    let tr = document.getElementById(table).querySelectorAll('tr')

    for (i = 0; i < tr.length; i++) {
        if (tr[i].querySelectorAll('th')[0].innerHTML == filter) {
            tr[i].querySelectorAll('th')[1].querySelector('button').classList.remove('pointer-events-none')
            tr[i].querySelectorAll('th')[1].querySelector('button').classList.remove('opacity-50')
        }
    }
}

/*
    It just works!
*/
function link_href(href) {
    document.getElementById('importModal').classList.add('modal-open')
    document.getElementById('importForm').action = href
}


/*
    This function is used to create an element in the notification-group within notification.blade.php
    Upon instantiation, another element will be created as div with increasing classlist. An inner html too will be added,
    the function takes in a parameter, a message, to be filled in the innerHTML below.

    This function also has a timer (setTimeout) of 3000 milliseconds, which will remove the element after 3 seconds.
*/
const notify = (message) => {
    const notification_group = document.getElementById('notification-group')
    let notification = document.createElement('div')
    notification.classList.add('card')
    notification.classList.add('z-[100]') // Z-index 100
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
        notification.remove()
    }, 3000)
}