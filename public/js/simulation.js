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
    }
}

function sort() {

}