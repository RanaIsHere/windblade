document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('package-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('package-view').classList.contains('hidden')) {
            document.getElementById('package-view').classList.remove('hidden')
            document.getElementById('package-view-btn').classList.add('btn-active')
            document.getElementById('package-creation').classList.add('hidden')
            document.getElementById('package-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('package-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('package-creation').classList.contains('hidden')) {
            document.getElementById('package-creation').classList.remove('hidden')
            document.getElementById('package-creation-btn').classList.add('btn-active')
            document.getElementById('package-view').classList.add('hidden')
            document.getElementById('package-view-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('outlet-search-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (!document.getElementById('addmembertopackage').classList.contains('modal-open')) {
            document.getElementById('addmembertopackage').classList.add('modal-open')
        }
    })
})


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
