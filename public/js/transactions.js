var PRICE = 0
var TAX = 0


function update_stats() {
	document.getElementById('fee_view').innerText = document.getElementById('fee_price').value
	document.getElementById('price_view').innerText = document.getElementById('transaction_price').value
	document.getElementById('tax_view').innerText = TAX
}

function update_discount(entity) {
	if (PRICE != 0) {
		let calculated_price = PRICE
		let calculated_discount = PRICE * (document.getElementById('discount_input').value / 100)
		calculated_price = calculated_price - calculated_discount

		TAX = calculated_price * (2 / 100)
		document.getElementById('price_view').innerText = parseInt(calculated_price)
		document.getElementById('discount_view').innerText = document.getElementById('discount_input').value
		document.getElementById('transaction_price').value = parseInt(calculated_price)
		document.getElementById('tax_price').value = TAX

		update_stats()
	}
}

function update_quantity(entity) {
	if (PRICE != 0) {
		let calculated_price = PRICE * entity.value
		let calculated_discount = calculated_price * (document.getElementById('discount_input').value / 100)
		calculated_price = calculated_price - calculated_discount

		TAX = calculated_price * (2 / 100)
		document.getElementById('price_view').innerText = parseInt(calculated_price)
		document.getElementById('discount_view').innerText = document.getElementById('discount_input').value
		document.getElementById('transaction_price').value = parseInt(calculated_price)
		document.getElementById('tax_price').value = TAX

		update_stats()
	}
}

// TODO: Secure calculation by sending it through the back-end, and back to the frontend.
function catch_price_information() {
	$.ajax({
		type: 'POST',
		url: '/get-price-information',
		data: { price: PRICE, discount: document.getElementById('discount_input').value, tax: TAX },
		success: function (response) {
			let calculated_price = PRICE
		}
	});
}

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

	update_stats()
}

function get_member(entity, index) {
	let table_element = entity.parentElement.parentElement
	let id = table_element.querySelectorAll('th')[index].innerText

	$.ajax({
		type: 'POST',
		url: '/catch-member',
		data: { id: id },
		success: function (response) {
			document.getElementById('member_input_real').value = response.response.id
			document.getElementById('member_input').value = response.response.member_name
			document.getElementById('find_member').classList.remove('modal-open')
		}
	});
}

function get_package(entity, index) {
	let table_element = entity.parentElement.parentElement
	let id = table_element.querySelectorAll('th')[index].innerText

	$.ajax({
		type: 'POST',
		url: '/catch-package',
		data: { id: id },
		success: function (response) {
			document.getElementById('package_input_real').value = response.response.id
			document.getElementById('package_input').value = response.response.package_name

			document.getElementById('transaction_price').value = response.response.package_price

			PRICE = response.response.package_price
			TAX = response.response.package_price * (5 / 100)

			document.getElementById('quantity_input').classList.remove('pointer-events-none')

			document.getElementById('find_package').classList.remove('modal-open')

			update_stats()
		}
	})
}


function add_package(entity) {
	let table_element = entity.parentElement.parentElement
	let id = table_element.querySelectorAll('th')[0].innerText

	$.ajax({
		type: 'POST',
		url: '/add-package',
		data: { id: id },
		success: function (response) {
			console.log(response)

			let buffer = document.getElementById('package-buffer')
			let tr = document.createElement('tr')

			let id_element = document.createElement('td')
			let package_name = document.createElement('td')
			let package_type = document.createElement('td')
			let package_price = document.createElement('td')
			let package_quantity = document.createElement('td')
			let actions = document.createElement('td')

			let quantity_input = document.createElement('input')
			let drop_input = document.createElement('button')
			buffer.appendChild(tr)

			tr.appendChild(id_element) // id	
			tr.appendChild(package_name) // package_name
			tr.appendChild(package_type) // package_type
			tr.appendChild(package_price) // package_price
			tr.appendChild(package_quantity) // package_quantity
			tr.appendChild(actions) // actions

			id_element.innerText = response.response.id
			package_name.innerText = response.response.package_name
			package_type.innerText = response.response.package_type
			package_price.innerText = response.response.package_price
			package_quantity.appendChild(quantity_input)
			actions.appendChild(drop_input)

			quantity_input.type = 'number'
			quantity_input.classList.add('input')
			quantity_input.classList.add('input-bordered')
			quantity_input.value = 1
			quantity_input.min = 1

			drop_input.type = 'button'
			drop_input.classList.add('btn')
			drop_input.classList.add('btn-accent')
			drop_input.innerText = 'DROP'

			document.getElementById('find_package').classList.remove('modal-open')
		}
	})
}