var PRICE = 0
var FEE = 0
var TAX = 0

function toggle_note(entity) {
    entity.checked != entity.checked
    document.getElementById('note_textarea').classList.toggle('hidden')

    var fee_price = document.getElementById('fee_price').value

    if (entity.checked) {
        fee_price += 5000
    } else {
        fee_price -= 5000
    }

    document.getElementById('fee_price').value = parseInt(fee_price)
    document.getElementById('fee_view').innerText = document.getElementById('fee_price').value
}

function update_statistics() {
    let chosen_id = CHOSEN
    let discount = document.getElementById('discount_input').value

    $.ajax({
        type: 'POST',
        url: '/calculate-price',
        data: { id: chosen_id, discount: discount },
        success: function (response) {
            PRICE = response.price
            TAX = response.tax

            document.getElementById('transaction_price').value = PRICE
            document.getElementById('tax_price').value = TAX

            document.getElementById('price_view').innerText = PRICE
            document.getElementById('fee_view').innerText = FEE
            document.getElementById('tax_view').innerText = TAX

            document.getElementById('discount_view').innerText = document.getElementById('discount_input').value
        }
    })
}

function update_quantity(entity) {
    let table_element = entity.parentElement.parentElement
    let id = Number(table_element.querySelectorAll('td')[0].innerText)
    let quantity = Number(table_element.querySelectorAll('td')[4].querySelector('input').value)

    CHOSEN[get_index(CHOSEN, 'id', id)]['quantity'] = quantity
}