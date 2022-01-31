function update_stats()
{
	document.getElementById('fee_view').innerText = document.getElementById('fee_price').value
	document.getElementById('price_view').innerText = document.getElementById('transaction_price').value
}

function catch_price_information()
{
	$.ajax({
		type: 'POST',
		url: '/get-price-information'

	});
}

function toggle_note(entity)
{
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

function get_member(entity, index)
{
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

function get_package(entity, index)
{
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
			document.getElementById('quantity_input').removeAttribute('disabled')

			document.getElementById('find_package').classList.remove('modal-open')

			update_stats()
		}
	})
}