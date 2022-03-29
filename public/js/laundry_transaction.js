const defaultArray = JSON.parse(localStorage.getItem('laundryData'))

const STANDARD = 7500
const EXPRESS = 10000

if (localStorage.getItem('laundryData')) {
    updateTable(defaultArray)
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('transaction_form').addEventListener('submit', function (e) {
        e.preventDefault()

        const idInput = document.getElementById('idInput').value
        const contactInput = document.getElementById('contactInput').value
        const laundryInput = document.getElementById('laundryInput').value
        const customerInput = document.getElementById('customerInput').value
        const dateInput = document.getElementById('dateInput').value
        const weightInput = document.getElementById('weightInput').value

        const table = document.getElementById('transaction-table')
        const tbody = table.getElementsByTagName('tbody')[0]

        let tr = document.createElement('tr')
        let idElement = document.createElement('td')
        let nameElement = document.createElement('td')
        let contactElement = document.createElement('td')
        let dateElement = document.createElement('td')
        let typeElement = document.createElement('td')
        let weightElement = document.createElement('td')
        let discountElement = document.createElement('td')
        let totalElement = document.createElement('td')

        tbody.appendChild(tr)
        tr.appendChild(idElement)
        tr.appendChild(nameElement)
        tr.appendChild(contactElement)
        tr.appendChild(dateElement)
        tr.appendChild(typeElement)
        tr.appendChild(weightElement)
        tr.appendChild(discountElement)
        tr.appendChild(totalElement)

        let total = 0
        let discount = 0

        // console.log(idInput)
        // console.log(contactInput)
        // console.log(laundryInput)
        // console.log(customerInput)
        // console.log(dateInput)
        // console.log(weightInput)

        if (laundryInput === 'Standard') {
            total = Number(STANDARD) * Number(weightInput)
        } else {
            total = Number(EXPRESS) * Number(weightInput)
        }

        if (total > 50000) {
            discount = total * (10 / 100)
        } else {
            discount = 0
        }

        total -= discount

        idElement.innerText = idInput
        nameElement.innerText = customerInput
        contactElement.innerText = contactInput
        typeElement.innerText = laundryInput
        weightElement.innerText = weightInput
        dateElement.innerText = dateInput
        discountElement.innerText = discount
        totalElement.innerText = total

        document.getElementById('transaction_form').reset()

        updateTotal()

        insertToStorage()
    })

    document.getElementById('searchForm').addEventListener('submit', (e) => {
        e.preventDefault()

        search(document.getElementById('searchInput'), 'transaction-table')
    })
})

function insertToStorage() {
    let tmp_arr = []
    let table = document.getElementById('transaction-table').getElementsByTagName('tbody')[0]

    for (let i = 0; i < table.children.length; i++) {
        const id = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerText
        const name = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerText
        const contact = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerText
        const date = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerText
        const type = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[4].innerText
        const weight = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[5].innerText
        const discount = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText
        const total = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText

        tmp_arr.push({
            'id': Number(id),
            'name': name,
            'contact': contact,
            'date': date,
            'type': type,
            'weight': weight,
            'discount': Number(discount),
            'total': Number(total),
        })
    }

    // console.log(tmp_arr)

    localStorage.setItem('laundryData', JSON.stringify([...tmp_arr]))
}

function getArray() {
    return JSON.parse(localStorage.getItem('laundryData'))
}

function updateTotal() {
    let table = document.getElementById('transaction-table').getElementsByTagName('tbody')[0]
    let totalTableWeight = 0
    let totalTableDiskon = 0
    let totalTableHarga = 0

    for (let i = 0; i < table.children.length; i++) {
        totalTableWeight += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[5].innerText)
        totalTableDiskon += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
        totalTableHarga += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)
    }

    document.getElementById('totalTableWeight').innerText = totalTableWeight
    document.getElementById('totalTableDiskon').innerText = totalTableDiskon
    document.getElementById('totalTableHarga').innerText = totalTableHarga
}

function updateTable(arr) {
    const table = document.getElementById('transaction-table')
    let tbody = document.createElement('tbody')

    table.removeChild(document.getElementById('transaction-table').getElementsByTagName('tbody')[0])
    table.appendChild(tbody)

    arr.forEach(arr => {
        let tr = document.createElement('tr')
        let idElement = document.createElement('td')
        let nameElement = document.createElement('td')
        let contactElement = document.createElement('td')
        let dateElement = document.createElement('td')
        let typeElement = document.createElement('td')
        let weightElement = document.createElement('td')
        let discountElement = document.createElement('td')
        let totalElement = document.createElement('td')


        tbody.appendChild(tr)
        tr.appendChild(idElement)
        tr.appendChild(nameElement)
        tr.appendChild(contactElement)
        tr.appendChild(dateElement)
        tr.appendChild(typeElement)
        tr.appendChild(weightElement)
        tr.appendChild(discountElement)
        tr.appendChild(totalElement)

        idElement.innerText = arr['id']
        nameElement.innerText = arr['name']
        contactElement.innerText = arr['contact']
        dateElement.innerText = arr['date']
        typeElement.innerText = arr['type']
        weightElement.innerText = arr['weight']
        discountElement.innerText = arr['discount']
        totalElement.innerText = arr['total']
    });

    updateTotal()

    insertToStorage()
}

/*
    Insertion Sort
*/
function sort(arr, key) {
    let i, j, id, value

    if (arr != null) {
        for (i = 1; i < arr.length; i++) {
            value = arr[i]
            id = arr[i][String(key)]
            j = i - 1

            // console.log("X: " + arr[j]['id'] + " is larger than " + "Y: " + id + " is " + String(arr[j]['id'] > id))

            while (j >= 0 && arr[j][String(key)] > id) {
                arr[j + 1] = arr[j]
                j -= 1
            }
            arr[j + 1] = value
        }


        updateTotal()

        updateTable(arr)
    }
}