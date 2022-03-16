// $('#salary-table').DataTable({
//     searching: false,
//     paging: false,
//     sort: false,
//     info: false
// })

let defaultArray = JSON.parse(localStorage.getItem('salaryData'))

if (localStorage.getItem('salaryData')) {
    updateTable(defaultArray)
}

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('statusInput').addEventListener('change', () => {
        if (document.getElementById('statusInput').value === 'SINGLE') {
            document.getElementById('childInput').disabled = true
            document.getElementById('childInput').value = 0
        } else {
            document.getElementById('childInput').disabled = false
        }
    })
})

function updateTable(arr) {
    const table = document.getElementById('salary-table')
    let tbody = document.createElement('tbody')

    table.removeChild(document.getElementById('salary-table').getElementsByTagName('tbody')[0])
    table.appendChild(tbody)

    arr.forEach(arr => {
        let tr = document.createElement('tr')
        let idElement = document.createElement('td')
        let nameElement = document.createElement('td')
        let genderElement = document.createElement('td')
        let statusElement = document.createElement('td')
        let childrenElement = document.createElement('td')
        let startElement = document.createElement('td')
        let baseSalaryElement = document.createElement('td')
        let supportSalaryElement = document.createElement('td')
        let totalSalaryElement = document.createElement('td')

        tbody.appendChild(tr)
        tr.appendChild(idElement)
        tr.appendChild(nameElement)
        tr.appendChild(genderElement)
        tr.appendChild(statusElement)
        tr.appendChild(childrenElement)
        tr.appendChild(startElement)
        tr.appendChild(baseSalaryElement)
        tr.appendChild(supportSalaryElement)
        tr.appendChild(totalSalaryElement)

        idElement.innerText = arr['id']
        nameElement.innerText = arr['name']
        genderElement.innerText = arr['gender']
        statusElement.innerText = arr['status']
        childrenElement.innerText = arr['childrens']
        startElement.innerText = arr['start']
        baseSalaryElement.innerText = arr['basesalary']
        supportSalaryElement.innerText = arr['supportSalary']
        totalSalaryElement.innerText = arr['totalSalary']
    });

    updateTotal()

    insertToStorage()
}

function updateTotal() {
    let table = document.getElementById('salary-table').getElementsByTagName('tbody')[0]
    let totalBaseSalary = 0
    let totalSupportSalary = 0
    let totalSalary = 0

    for (let i = 0; i < table.children.length; i++) {
        totalBaseSalary += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText)
        totalSupportSalary += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText)
        totalSalary += Number(table.getElementsByTagName('tr')[i].getElementsByTagName('td')[8].innerText)
    }

    document.getElementById('totalBaseSalary').innerText = totalBaseSalary
    document.getElementById('totalSupportSalary').innerText = totalSupportSalary
    document.getElementById('totalSalary').innerText = totalSalary
}

function insertToStorage() {
    let tmp_arr = []
    let table = document.getElementById('salary-table').getElementsByTagName('tbody')[0]

    for (let i = 0; i < table.children.length; i++) {
        const id = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerText
        const name = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerText
        const gender = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerText
        const status = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[3].innerText
        const childrens = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[4].innerText
        const start = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[5].innerText
        const basesalary = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[6].innerText
        const supportSalary = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[7].innerText
        const totalSalary = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[8].innerText

        tmp_arr.push({
            'id': Number(id),
            'name': name,
            'gender': gender,
            'status': status,
            'childrens': Number(childrens),
            'start': start,
            'basesalary': Number(basesalary),
            'supportSalary': Number(supportSalary),
            'totalSalary': Number(totalSalary)
        })
    }

    localStorage.setItem('salaryData', JSON.stringify([...tmp_arr]))
}

document.getElementById('salaryForm').addEventListener('submit', function (e) {
    e.preventDefault()

    submit_workers()
})

function submit_workers() {
    // Data
    const id = document.getElementById('idInput').value
    const gender = document.getElementById('genderInput').value
    const children = document.getElementById('childInput').value
    const name = document.getElementById('nameInput').value
    const status = document.getElementById('statusInput').value
    const date = document.getElementById('dateInput').value

    let currentDate = new Date()
    let dateConverted = new Date(date).getFullYear()
    let supportSalary = 0

    // Table
    const table = document.getElementById('salary-table')
    const tbody = table.getElementsByTagName('tbody')[0]

    // Elements
    let tr = document.createElement('tr')
    let idElement = document.createElement('td')
    let nameElement = document.createElement('td')
    let genderElement = document.createElement('td')
    let statusElement = document.createElement('td')
    let childrenElement = document.createElement('td')
    let startElement = document.createElement('td')
    let baseSalaryElement = document.createElement('td')
    let supportSalaryElement = document.createElement('td')
    let totalSalaryElement = document.createElement('td')

    tbody.appendChild(tr)
    tr.appendChild(idElement)
    tr.appendChild(nameElement)
    tr.appendChild(genderElement)
    tr.appendChild(statusElement)
    tr.appendChild(childrenElement)
    tr.appendChild(startElement)
    tr.appendChild(baseSalaryElement)
    tr.appendChild(supportSalaryElement)
    tr.appendChild(totalSalaryElement)

    idElement.innerText = id
    nameElement.innerText = name
    genderElement.innerText = gender
    statusElement.innerText = status
    childrenElement.innerText = children
    startElement.innerText = date
    baseSalaryElement.innerText = '2000000'

    // console.log(calculateAge(date))

    if (currentDate > dateConverted) {
        for (let i = 0; i < calculateAge(date); i++) {
            supportSalary += 150000
        }
    }

    if (statusElement.innerText == 'MARRIED') {
        supportSalary += 250000
    }

    if (Number(childrenElement.innerText) > 0) {
        for (let i = 0; i < Number(childrenElement.innerText); i++) {
            if (i < 2) {
                supportSalary += 150000
            }
        }
    }

    supportSalaryElement.innerText = supportSalary
    totalSalaryElement.innerText = Number(baseSalaryElement.innerText) + Number(supportSalaryElement.innerText)
    updateTotal()

    insertToStorage()

    document.getElementById('idInput').value = ''
    document.getElementById('genderInput').value = ''
    document.getElementById('childInput').value = ''
    document.getElementById('nameInput').value = ''
    document.getElementById('statusInput').value = ''
    document.getElementById('dateInput').value = ''
}

function get_id() {
    return JSON.parse(localStorage.getItem('salaryData'))
}

// This calculates the difference of year accurately, instead of a comparison between a singular number of years.
function calculateAge(startOfWork) {
    let startOFWork = new Date(startOfWork)
    let ageDiffMs = Date.now() - startOFWork.getTime()
    let ageDate = new Date(ageDiffMs)
    return Math.abs(ageDate.getUTCFullYear() - 1970)
}

// Insertion sort
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
}
