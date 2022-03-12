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

    for (let i = 0; i < document.getElementsByClassName('reportSchedule').length; i++) {
        document.getElementsByClassName('reportSchedule')[i].addEventListener('click', function (event) {
            event.preventDefault()

            const parent = event.currentTarget.parentNode
            const id = parent.getElementsByTagName('p')[0].innerText

            event.currentTarget.classList.add('loading')

            setTimeout(function () {
                $.ajax({
                    url: '/reportSchedule',
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: { id: Number(id) },
                    success: function (response) {
                        const date = new Date(response.date)
                        const month = date.getMonth()
                        const day = date.getDate()
                        const dayElement = document.getElementById('days')

                        for (let i = 0; i < dayElement.children.length; i++) {
                            if (dayElement.children[i].getElementsByTagName('div')[0].innerText == day) {
                                dayElement.children[i].getElementsByTagName('div')[0].style.backgroundColor = '#98c761'
                            }
                        }

                        event.target.classList.remove('loading')
                        addNotification()
                    }
                })
            }, 1000)
        })
    }
})

function addNotification() {
    const notification_group = document.getElementById('notification-group')
    let notification = document.createElement('div')
    notification.classList.add('card')
    notification.classList.add('w-80')
    notification.classList.add('bg-green-200')
    notification.classList.add('shadow-xl')
    notification.classList.add('mt-4')

    notification.innerHTML = `
    <div class="card-body">
        <div class="flex">
            <h2 class="card-title mx-2">Schedule found!</h2>
            <button class="btn btn-primary btn-sm mx-2"
                onclick="this.parentElement.parentElement.parentElement.remove()">
                Close</button>
        </div>  
    </div>`

    notification_group.appendChild(notification)
}
