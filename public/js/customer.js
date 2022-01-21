document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('customer-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('customer-view').classList.contains('hidden')) {
            document.getElementById('customer-view').classList.remove('hidden')
            document.getElementById('customer-view-btn').classList.add('btn-active')
            document.getElementById('customer-creation').classList.add('hidden')
            document.getElementById('customer-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('customer-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('customer-creation').classList.contains('hidden')) {
            document.getElementById('customer-creation').classList.remove('hidden')
            document.getElementById('customer-creation-btn').classList.add('btn-active')
            document.getElementById('customer-view').classList.add('hidden')
            document.getElementById('customer-view-btn').classList.remove('btn-active')
        }
    })

})