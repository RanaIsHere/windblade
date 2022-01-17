document.addEventListener('DOMContentLoaded', function (e) {
    document.getElementById('requestRegistration').addEventListener('click', function (e) {
        e.preventDefault()

        document.getElementById('requestreg').classList.add('modal-open')
    })
})