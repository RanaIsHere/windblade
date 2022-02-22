document.addEventListener('DOMContentLoaded', function () {
    const buffer = document.getElementById('invoice-buffer-table')
    let price_total = 0
    let quantity_total = 0

    for (i = 0; i < buffer.children.length; i++) {
        price_total += parseInt(Number(buffer.querySelectorAll('tr')[i].querySelectorAll('td')[2].innerText)) * parseInt(Number(buffer.querySelectorAll('tr')[i].querySelectorAll('td')[3].innerText))
        quantity_total += parseInt(Number(buffer.querySelectorAll('tr')[i].querySelectorAll('td')[3].innerText))
    }

    document.getElementById('total_price').innerText = price_total
    document.getElementById('total_quantity').innerText = quantity_total
})