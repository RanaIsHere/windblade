$('#invoice-table').DataTable();

function view_invoice(entity) {
    let table_element = entity.parentElement.parentElement
    let id = table_element.querySelector('th').innerText

    $.ajax({
        type: 'POST',
        url: '/fetch-invoice',
        data: { id: id },
        success: function (response) {
            console.log(response)

            document.getElementById('view_invoice').classList.add('modal-open')

            document.getElementById('transaction_id').innerText = response.response[0].transaction_id
            document.getElementById('invoice_code').innerText = response.response[1].invoice_code
            document.getElementById('member_name').innerText = response.response[2].member_name
            document.getElementById('member_phone').innerText = response.response[2].member_phone
            document.getElementById('package_name').innerText = response.response[3].package_name
            document.getElementById('package_type').innerText = response.response[3].package_type
            document.getElementById('package_price').innerText = response.response[3].package_price
        }
    })
}