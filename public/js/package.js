document.addEventListener('DOMContentLoaded', function (e) {

    document.getElementById('package-view-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('package-view').classList.contains('hidden')) {
            document.getElementById('package-view').classList.remove('hidden')
            document.getElementById('package-view-btn').classList.add('btn-active')
            document.getElementById('package-creation').classList.add('hidden')
            document.getElementById('package-creation-btn').classList.remove('btn-active')
        }
    })

    document.getElementById('package-creation-btn').addEventListener('click', function (e) {
        e.preventDefault()

        if (document.getElementById('package-creation').classList.contains('hidden')) {
            document.getElementById('package-creation').classList.remove('hidden')
            document.getElementById('package-creation-btn').classList.add('btn-active')
            document.getElementById('package-view').classList.add('hidden')
            document.getElementById('package-view-btn').classList.remove('btn-active')
        }
    })

})