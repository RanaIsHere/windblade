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

function enable_pay_later(entity) {
	document.getElementById('pay_with_cash').classList.remove('opacity-50')
	document.getElementById('pay_with_cash').classList.remove('pointer-events-none')

	entity.classList.add('opacity-50')
	entity.classList.add('pointer-events-none')
}

function enable_cash_pay(entity) {
	document.getElementById('pay_later').classList.remove('opacity-50')
	document.getElementById('pay_later').classList.remove('pointer-events-none')

	entity.classList.add('opacity-50')
	entity.classList.add('pointer-events-none')
}

function search(search, table) {
	let record, success;
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

// function sort(table) {
// 	let switching = true
// 	let filter = document.getElementById('group_by').value
// 	let table_element = document.getElementById(table)
// 	let rows = table_element.querySelector('tbody').getElementsByTagName('tr')

// 	console.log(filter)

// 	while (switching) {
// 		// Start by saying: no switching is done:
// 		switching = false;
// 		/* Loop through all table rows (except the
// 		first, which contains table headers): */
// 		for (i = 1; i < rows.length; i++) {
// 			// Start by saying there should be no switching:
// 			shouldSwitch = false;
// 			x = rows[i].getElementsByTagName('td')[0];
// 			y = rows[i + 1].getElementsByTagName('td')[0];
// 			if (filter == "ASCENDING") {
// 				if (Number(x.innerHTML.toLowerCase()) > Number(y.innerHTML.toLowerCase())) {
// 					shouldSwitch = true;
// 					break;
// 				}
// 			} else if (filter == "DESCENDING") {
// 				if (Number(x.innerHTML.toLowerCase()) < Number(y.innerHTML.toLowerCase())) {
// 					shouldSwitch = true;
// 					break;
// 				}
// 			}
// 		}
// 		if (shouldSwitch) {
// 			/* If a switch has been marked, make the switch
// 			and mark that a switch has been done: */
// 			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
// 			switching = true;
// 			switchcount++;
// 		} else {
// 			/* If no switching has been done AND the direction is "asc",
// 			set the direction to "desc" and run the while loop again. */
// 			if (switchcount == 0 && dir == "ASCENDING") {
// 				filter = "DESCENDING";
// 				switching = true;
// 			}
// 		}
// 	}
// }