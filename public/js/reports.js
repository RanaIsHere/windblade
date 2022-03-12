var socket = io('127.0.0.1:3000');

socket.emit('connection')

socket.on('requestMessage', (id, user, message) => {
    let chatbox = document.getElementById('chat-box')

    console.log(id === Number(document.getElementById('fromId').value))

    if (id === Number(document.getElementById('fromId').value)) {
        chatbox.insertAdjacentHTML('beforeend', '<p class="text-right">' + user + ': ' + message + '</p>')
    } else {
        chatbox.insertAdjacentHTML('beforeend', '<p>' + user + ': ' + message + '</p>')
    }

    $('#chat-box').scrollTop($('#chat-box').height() * 100)
})

$('#transaction-table').DataTable({
    "pageLength": 6,
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
        },

        {
            extend: 'pdf',
        }
    ]
})

document.addEventListener('DOMContentLoaded', () => {
    $('#chat-box').scrollTop($('#chat-box').height() * 100)

    document.getElementById('messageForm').addEventListener('submit', function (e) {
        e.preventDefault()

        let messageData = document.getElementById('chatInput').value
        document.getElementById('chatInput').value = ''

        if (messageData != null || messageData != "") {
            $.ajax({
                type: 'POST',
                url: '/sendRequestMessage',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: { message: messageData },
                success: function (response) {
                    socket.emit('sendMessage', response.id, response.user, response.response.message)
                }
            })
        }
    })

    for (let i = 0; i < document.getElementsByClassName('startMessage').length; i++) {
        document.getElementsByClassName('startMessage')[i].addEventListener('click', function (e) {
            e.preventDefault()

            let card = this.parentElement.parentElement
            let id = card.getElementsByTagName('input')[0].value
            let user = card.getElementsByTagName('h2')[0].getElementsByTagName('span')[0].innerText

            // console.log(username + role + id)

            socket.emit('joinRoom', id, user)
        })
    }

    for (let i = 0; i < document.getElementsByClassName('changeTabs').length; i++) {
        document.getElementsByClassName('changeTabs')[i].addEventListener('click', function (entity) {
            entity.preventDefault()

            const parent = entity.currentTarget.parentElement
            const tabs = ['reports', 'schedule', 'requests', 'logs']

            for (i = 0; i < parent.children.length; i++) {
                if (parent.querySelectorAll('a')[i].classList.contains('tab-active')) {

                    parent.querySelectorAll('a')[i].classList.remove('tab-active')
                    parent.querySelectorAll('a')[i].classList.remove('text-opacity-100')

                    entity.currentTarget.classList.add('tab-active')
                    entity.currentTarget.classList.add('text-opacity-100')

                    if (tabs[i] != String(entity.currentTarget.innerText).toLowerCase()) {
                        if (Number(i) > Number(i + 1) == false) {
                            if (Number(i) < Number(i - 1) == false) {
                                document.getElementById(tabs[i] + '-view').classList.add('hidden')
                                document.getElementById(String(entity.currentTarget.innerText).toLowerCase() + '-view').classList.remove('hidden')
                            }
                        }
                    }
                }
            }
        })
    }
})