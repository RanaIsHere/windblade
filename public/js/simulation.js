let default_item = JSON.parse(localStorage.getItem('simulationData'))

if (localStorage.getItem('simulationData')) {
    updateTable(default_item)
}

function submit_simulation() {
    let table = document.getElementById('simulation-table-tbody')
    let id = document.getElementById('idInput').value
    let name = document.getElementById('nameInput').value
    let gender = document.getElementById('genderInput').value

    if (gender != 'Pick a gender' && name != '') {

        document.getElementById('idInput').value = ''
        document.getElementById('nameInput').value = ''

        let tr = document.createElement('tr')
        let idElement = document.createElement('td')
        let nameElement = document.createElement('td')
        let genderElement = document.createElement('td')

        table.appendChild(tr)
        tr.appendChild(idElement)
        tr.appendChild(nameElement)
        tr.appendChild(genderElement)

        idElement.innerText = id
        nameElement.innerText = name
        genderElement.innerText = gender

        insertToStorage()
    } else {
        alert('Name and gender required')
    }
}

function insertToStorage() {
    let tmp_arr = []
    let table = document.getElementById('simulation-table-tbody')

    for (let i = 0; i < table.children.length; i++) {
        const id = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerText
        const name = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerText
        const gender = table.getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerText


        tmp_arr.push({
            'id': Number(id),
            'name': name,
            'gender': gender
        })
    }

    localStorage.setItem('simulationData', JSON.stringify([...tmp_arr]))
}

function get_id() {
    let tmp_arr = []
    let tbody = document.getElementById('simulation-table-tbody')

    for (i = 0; i < tbody.children.length; i++) {
        let elements = tbody.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].innerText
        let name = tbody.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].innerText
        let gender = tbody.getElementsByTagName('tr')[i].getElementsByTagName('td')[2].innerText

        tmp_arr.push({
            "id": Number(elements),
            "name": String(name),
            "gender": String(gender),
        })
    }

    return tmp_arr
}

function updateTable(arr) {
    const table = document.getElementById('simulation-table')
    let tbody = document.createElement('tbody')
    tbody.id = 'simulation-table-tbody'

    table.removeChild(table.getElementsByTagName('tbody')[0])
    table.appendChild(tbody)

    arr.forEach(arr => {
        let tr = document.createElement('tr')
        let id = document.createElement('td')
        let name = document.createElement('td')
        let gender = document.createElement('td')

        tbody.appendChild(tr)
        tr.appendChild(id)
        tr.appendChild(name)
        tr.appendChild(gender)

        id.innerText = arr['id']
        name.innerText = arr['name']
        gender.innerText = arr['gender']
    });

    insertToStorage()
}

function sort(arr) {
    if (document.getElementById('filterInput').value == 'DESC') {
        console.log('DESC')

        let i, j, id, value
        for (i = 1; i < arr.length; i++) {
            value = arr[i]
            id = arr[i]['id']
            j = i - 1

            // console.log("X: " + arr[j]['id'] + " is larger than " + "Y: " + id + " is " + String(arr[j]['id'] > id))

            while (j >= 0 && arr[j]['id'] > id) {
                arr[j + 1] = arr[j]
                j -= 1
            }
            arr[j + 1] = value
        }

        updateTable(arr)
    } else {
        console.log('ASC')
        let i, j, id, value
        for (i = 1; i < arr.length; i++) {
            value = arr[i]
            id = arr[i]['id']
            j = i - 1

            // console.log("X: " + arr[j]['id'] + " is larger than " + "Y: " + id + " is " + String(arr[j]['id'] > id))

            while (j >= 0 && arr[j]['id'] < id) {
                arr[j + 1] = arr[j]
                j -= 1
            }
            arr[j + 1] = value
        }

        updateTable(arr)
    }
}