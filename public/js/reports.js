var socket = io('127.0.0.1:3000');

socket.emit('connection')

$('#transaction-table').DataTable({
    "pageLength": 6
})

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('messageForm').addEventListener('submit', function (e) {
        e.preventDefault()

        let messageData = document.getElementById('chatInput').value
        document.getElementById('chatInput').value = ''

        if (messageData != null || messageData != "") {
            $.ajax({
                type: 'POST',
                url: '/sendRequestMessage',
                data: { message: messageData },
                success: function (response) {
                    document.getElementById('chat-box').insertAdjacentHTML('beforeend', '<p>' + response.user + ': ' + response.response.message + '</p>')
                }
            })
        }
    })
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
