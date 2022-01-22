document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('outlet-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('outlet-view').classList.contains('hidden')) {
            document.getElementById('outlet-view').classList.remove('hidden')
            document.getElementById('outlet-view-btn').classList.add('btn-active')
            document.getElementById('outlet-creation').classList.add('hidden')
            document.getElementById('outlet-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('outlet-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('outlet-creation').classList.contains('hidden')) {
            document.getElementById('outlet-creation').classList.remove('hidden')
            document.getElementById('outlet-creation-btn').classList.add('btn-active')
            document.getElementById('outlet-view').classList.add('hidden')
            document.getElementById('outlet-view-btn').classList.remove('btn-active')
        }
    })

})