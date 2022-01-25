document.getElementById('register_checkbox').checked = false

function next_page(current, next, count) {
    let steps = document.getElementById('step-tracking')
    let currentPage = document.getElementById(current)
    let nextPage = document.getElementById(next)

    currentPage.classList.add('hidden')
    nextPage.classList.remove('hidden')
    steps.querySelectorAll('li')[count].classList.add('step-primary')
}