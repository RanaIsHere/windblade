document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('fileInput').addEventListener('change', function (e) {
        e.preventDefault()

        document.getElementById('fileNameInput').value = this.files[0].name
    })
})

const uploadBtn = () => {
    document.getElementById('fileInput').click()
}
