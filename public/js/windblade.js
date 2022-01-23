$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

document.addEventListener('DOMContentLoaded', function (e) {
    document.getElementById('requestRegistration').addEventListener('click', function (e) {
        e.preventDefault()

        document.getElementById('requestreg').classList.add('modal-open')
    })
})