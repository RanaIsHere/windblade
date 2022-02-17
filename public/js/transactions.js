var CHOSEN = [];

function package_available(id) {
	if (CHOSEN.length > 0) {
		for (i = 0; i < CHOSEN.length; i++) {
			if (CHOSEN[i]['id'] == Number(id)) {
				return true
			}
		}

		return false
	} else {
		return false
	}
}

function add_package(entity) {
	let table_element = entity.parentElement.parentElement
	let id = table_element.querySelectorAll('th')[0].innerText

	entity.classList.add('pointer-events-none')
	entity.classList.add('opacity-50')

	if (!package_available(id)) {
		$.ajax({
			type: 'POST',
			url: '/add-package',
			data: { id: id },
			success: function (response) {
				let buffer = document.getElementById('package-buffer')
				let form_element = document.getElementById('package-information')
				let tr = document.createElement('tr')

				let input_id = document.createElement('input')
				let input_quantity = document.createElement('input')

				let id_element = document.createElement('td')
				let package_name = document.createElement('td')
				let package_type = document.createElement('td')
				let prefix_price = document.createElement('td')
				let package_quantity = document.createElement('td')
				let actions = document.createElement('td')

				let quantity_input = document.createElement('input')
				let drop_input = document.createElement('button')
				let package_price = document.createElement('span')
				buffer.appendChild(tr)

				tr.appendChild(id_element) // id	
				tr.appendChild(package_name) // package_name
				tr.appendChild(package_type) // package_type
				tr.appendChild(prefix_price) // package_price
				tr.appendChild(package_quantity) // package_quantity
				tr.appendChild(actions) // actions

				prefix_price.innerText = 'Rp. '
				prefix_price.appendChild(package_price)

				id_element.innerText = response.response.id
				package_name.innerText = response.response.package_name
				package_type.innerText = response.response.package_type
				package_price.innerText = response.response.package_price

				package_quantity.appendChild(quantity_input)
				actions.appendChild(drop_input)

				quantity_input.type = 'number'
				quantity_input.classList.add('input')
				quantity_input.classList.add('input-bordered')
				quantity_input.setAttribute('onchange', 'update_quantity(this)')
				quantity_input.value = 1
				quantity_input.min = 1

				drop_input.type = 'button'
				drop_input.classList.add('btn')
				drop_input.classList.add('btn-accent')
				drop_input.innerText = 'DROP'
				drop_input.setAttribute("onclick", 'remove_package(this)')

				CHOSEN.push({ id: Number(response.response.id), quantity: Number(quantity_input.value) })

				form_element.appendChild(input_id)
				form_element.appendChild(input_quantity)

				input_id.type = "hidden"
				input_id.name = 'chosen_packages[' + get_index(CHOSEN, 'id', response.response.id) + '][id]'
				input_id.value = response.response.id
				input_id.id = 'id-input-' + response.response.id

				input_quantity.type = "hidden"
				input_quantity.name = 'chosen_packages[' + get_index(CHOSEN, 'id', response.response.id) + '][quantity]'
				input_quantity.value = quantity_input.value
				input_quantity.id = 'qty-input-' + response.response.id



				update_statistics()

				document.getElementById('find_package').classList.remove('modal-open')
			}
		})
	}
}

function remove_package(entity) {
	let table_element = entity.parentElement.parentElement
	let id = Number(table_element.querySelectorAll('td')[0].innerText)

	CHOSEN.splice(get_index(CHOSEN, 'id', id), 1)
	document.getElementById('id-input-' + id).remove()
	document.getElementById('qty-input-' + id).remove()

	sift_table('package-buffer-list', id)

	table_element.remove()

	update_statistics()
}

function change_pay(entity) {
	if (entity.value != null) {
		document.getElementById('pay-input').classList.remove('hidden')
	}
}