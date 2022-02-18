$('#invoice-table').DataTable();

function exit_invoice() {
    let tbody = document.createElement('tbody')

    document.getElementById('view_invoice').classList.remove('modal-open')
    document.getElementById('invoice-buffer-table').remove()

    document.getElementById('invoice-package-table').appendChild(tbody)
    tbody.id = 'invoice-buffer-table'
}

function view_invoice(entity) {
    let table_element = entity.parentElement.parentElement
    let id = table_element.querySelector('th').innerText

    $.ajax({
        type: 'POST',
        url: '/fetch-invoice',
        data: { id: id },
        success: function (response) {
            let quantity_total = 0
            let price_total = 0

            document.getElementById('view_invoice').classList.add('modal-open')

            document.getElementById('discount').innerText = response.response[1].transaction_discount
            document.getElementById('invoiceCode').innerText = response.response[1].invoice_code
            document.getElementById('timeOfInvoice').innerText = response.response[1].transaction_date
            document.getElementById('nameOfCustomer').innerText = response.response[2].member_name
            document.getElementById('phoneOfCustomer').innerText = response.response[2].member_phone
            document.getElementById('genderOfCustomer').innerText = response.response[2].member_gender
            document.getElementById('sentTo').innerText = response.response[2].member_address
            document.getElementById('nameOfOutlet').innerText = response.response[4].outlet_name
            document.getElementById('phoneOfOutlet').innerText = response.response[4].outlet_phone
            document.getElementById('sentFrom').innerText = response.response[4].outlet_address

            for (i = 0; i < response.lists.length; i++) {
                let buffer = document.getElementById('invoice-buffer-table')
                let tr = document.createElement('tr')
                let id_element = document.createElement('th')
                let package_name = document.createElement('td')
                let package_type = document.createElement('td')
                let package_price = document.createElement('td')
                let package_quantity = document.createElement('td')

                buffer.appendChild(tr)
                tr.appendChild(id_element)
                tr.appendChild(package_name)
                tr.appendChild(package_type)
                tr.appendChild(package_price)
                tr.appendChild(package_quantity)

                id_element.innerText = response.lists[i]['id']
                package_name.innerText = response.lists[i]['packages']["package_name"]
                package_type.innerText = response.lists[i]['packages']["package_type"]
                package_price.innerText = 'Rp, ' + response.lists[i]['packages']["package_price"]
                package_quantity.innerText = response.lists[i]['quantity']

                price_total += parseInt(Number(response.lists[i]['packages']["package_price"]))
                quantity_total += parseInt(Number(response.lists[i]['quantity']))
            }

            document.getElementById('total_quantity').innerText = quantity_total
            document.getElementById('total_price').innerText = price_total
            document.getElementById('very_total').innerHTML = response.response[1].transaction_paid

            quantity_total = 0
        }
    })
}