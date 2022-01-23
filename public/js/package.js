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

function request_info(el, casual_input, real_input, modal) {
    let table_element = el.parentElement.parentElement
    let id = table_element.querySelector('th').innerHTML

    console.log(table_element)

    document.getElementById(modal).classList.add('modal-open')
    document.getElementById('package_id').value = id

    var request = new XMLHttpRequest();

    request.open('POST', '/get-package', true);
    request.setRequestHeader("X-CSRF_TOKEN", document.head.querySelector("meta[name='csrf-token']").content);

    $.ajax({
        type: 'POST',
        url: '/get-package',
        data: { id: id },
        success: function (response) {
            console.log(response.response)

            document.getElementById(casual_input).value = response.response.outlets.outlet_name
            document.getElementById(real_input).value = response.response.outlet_id
            document.getElementById('price_input_edit').value = response.response.package_price
            document.getElementById('name_input_edit').value = response.response.package_name
            document.getElementById('type_input_edit').value = response.response.package_type
        }
    })
}