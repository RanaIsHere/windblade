$('#transaction-table').DataTable({
    "pageLength": 6
})

function change_tab(entity) {
    const parent = entity.parentElement

    for (i = 0; i < parent.children.length; i++) {
        if (parent.querySelectorAll('a')[i].classList.contains('tab-active')) {
            parent.querySelectorAll('a')[i].classList.remove('tab-active')
            parent.querySelectorAll('a')[i].classList.remove('text-opacity-100')

            entity.classList.add('tab-active')
            entity.classList.add('text-opacity-100')
        }
    }
}
