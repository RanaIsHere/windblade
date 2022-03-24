const detergent = 15000
const perfume = 10000
const shoe_detergent = 25000

let defaultArray = JSON.parse(localStorage.getItem('transactionData'))

if (localStorage.getItem('transactionData')) {
    updateTable(defaultArray)
}

document.getElementById('transactForm').addEventListener('submit', function (e) {
    e.preventDefault()

    const workerId = document.getElementById('idInput')
    const packageName = document.getElementById('packageInput')
    const priceInput = document.getElementById('priceInput').innerText
    const quantity = document.getElementById('quantityInput')
    const dateInput = document.getElementById('dateInput')
    const cashRadioInput = document.getElementById('cashRadioInput')
    const transferRadioInput = document.getElementById('transferRadioInput')

    const table = document.getElementById('transactor-table')
    const tbody = table.getElementsByTagName('tbody')[0]

    let tr = document.createElement('tr')
    let idElement = document.createElement('td')
    let dateElement = document.createElement('td')
    let nameElement = document.createElement('td')
    let priceElement = document.createElement('td')
    let quantityElement = document.createElement('td')
    let discountElement = document.createElement('td')
    let totalPriceElement = document.createElement('td')
    let typeElement = document.createElement('td')

    tbody.appendChild(tr)
    tr.appendChild(idElement)
    tr.appendChild(dateElement)
    tr.appendChild(nameElement)
    tr.appendChild(priceElement)
    tr.appendChild(quantityElement)
    tr.appendChild(discountElement)
    tr.appendChild(totalPriceElement)
    tr.appendChild(typeElement)


    idElement.innerText = workerId.value
    dateElement.innerText = dateInput.value
    nameElement.innerText = packageName.value
    priceElement.innerText = getPackagePrice()
    quantityElement.innerText = quantity.value
    totalPriceElement.innerText = Number(getPackagePrice()) * Number(quantity.value)

    if (Number(totalPriceElement.innerText) >= 50000) {
        discountElement.innerText = Number(totalPriceElement.innerText) * (15 / 100)
    } else {
        discountElement.innerText = 0
    }

    typeElement.innerText = cashRadioInput.checked ? 'CASH' : 'E-MONEY'

    document.getElementById('priceInput').innerText = 0
    document.getElementById('transactForm').reset()

    updateTotal()

    insertToStorage()
})

function updateTable(arr) {
    const table = document.getElementById('transactor-table')
    let tbody = document.createElement('tbody')

    table.removeChild(document.getElementById('transactor-table').getElementsByTagName('tbody')[0])
    table.appendChild(tbody)

    arr.forEach(arr => {
        let tr = document.createElement('tr')
        let idElement = document.createElement('td')
        let dateElement = document.createElement('td')
        let nameElement = document.createElement('td')
        let priceElement = document.createElement('td')
        let quantityElement = document.createElement('td')
        let discountElement = document.createElement('td')
        let totalPriceElement = document.createElement('td')
        let typeElement = document.createElement('td')

        tbody.appendChild(tr)
        tr.appendChild(idElement)
        tr.appendChild(dateElement)
        tr.appendChild(nameElement)
        tr.appendChild(priceElement)
        tr.appendChild(quantityElement)
        tr.appendChild(discountElement)
        tr.appendChild(totalPriceElement)
        tr.appendChild(typeElement)

        idElement.innerText = arr['id']
        dateElement.innerText = arr['date']
        nameElement.innerText = arr['name']
        priceElement.innerText = arr['price']
        quantityElement.innerText = arr['quantity']
        discountElement.innerText = arr['discount']
        totalPriceElement.innerText = arr['total']
        typeElement.innerText = arr['type']
    });

    updateTotal()

    insertToStorage()
}

function getPackagePrice() {
    const package = document.getElementById('packageInput')
    let price = 0

    if (package.value == 'DETERGENT') {
        price = detergent
    } else if (package.value == 'PERFUME') {
        price = perfume
    } else if (package.value == 'SHOE_DETERGENT') {
        price = shoe_detergent
    }

    return price
}

function changePackage(entity) {
    if (entity.value == 'DETERGENT') {
        document.getElementById('priceInput').innerText = detergent
    } else if (entity.value == 'PERFUME') {
        document.getElementById('priceInput').innerText = perfume
    } else if (entity.value == 'SHOE_DETERGENT') {
        document.getElementById('priceInput').innerText = shoe_detergent
    }
}

function updateTotal() {
    let table = document.getElementById('transactor-table').getElementsByTagName('tbody')[0]
    let totalTableNormalPrice = 0
    let totalTableQuantity = 0
    let totalTableDiscount = 0
    let totalTablePrice = 0

    for (let i = 0; i < table.children.length; i++) {
        totalTableNormalPrice += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerText)
        totalTableQuantity += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[4].innerText)
        totalTableDiscount += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[5].innerText)
        totalTablePrice += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
    }

    document.getElementById('totalTableNormalPrice').innerText = totalTableNormalPrice
    document.getElementById('totalTableQuantity').innerText = totalTableQuantity
    document.getElementById('totalTableDiscount').innerText = totalTableDiscount
    document.getElementById('totalTablePrice').innerText = totalTablePrice
}

function insertToStorage() {
    let tmp_arr = []
    let table = document.getElementById('transactor-table').getElementsByTagName('tbody')[0]

    for (let i = 0; i < table.children.length; i++) {
        const id = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerText
        const date = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerText
        const name = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerText
        const price = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerText
        const quantity = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[4].innerText
        const discount = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[5].innerText
        const total = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText
        const type = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText

        tmp_arr.push({
            'id': Number(id),
            'date': date,
            'name': name,
            'price': Number(price),
            'quantity': Number(quantity),
            'discount': Number(discount),
            'total': Number(total),
            'type': type,
        })
    }

    localStorage.setItem('transactionData', JSON.stringify([...tmp_arr]))
}

function getArray() {
    return JSON.parse(localStorage.getItem('transactionData'))
}

function setSorter() {
    const table = document.getElementById('transactor-table').getElementsByTagName('tbody')[0]
    let sortMoney = document.getElementById('checkBoxSortMoney').checked
    let sortCash = document.getElementById('checkBoxSortCash').checked

    if (sortMoney) {
        for (let i = 0; i < table.children.length; i++) {
            console.log(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)

            if (String(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText) == String('E-MONEY')) {
                table.getElementsByTagName('tr')[i].style.display = 'table-row'
            }
        }
    } else {
        for (let i = 0; i < table.children.length; i++) {
            if (String(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText) == String('E-MONEY')) {
                table.getElementsByTagName('tr')[i].style.display = 'none'
            }
        }
    }

    if (sortCash) {
        for (let i = 0; i < table.children.length; i++) {
            if (String(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText) == String('CASH')) {
                table.getElementsByTagName('tr')[i].style.display = 'table-row'
            }
        }
    } else {
        for (let i = 0; i < table.children.length; i++) {
            if (String(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText) == String('CASH')) {
                table.getElementsByTagName('tr')[i].style.display = 'none'
            }
        }
    }
}

function sort(arr, key) {
    let i, j, id, value

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

    setSorter()
}
