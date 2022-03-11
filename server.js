const express = require('express')
const app = express()
const http = require('http')
const server = http.createServer(app)
const io = require('socket.io')(server, {
    cors: { origin: "*" }
})

io.on('connection', (socket) => {
    console.log('An user has connected to the server')

    socket.on('sendMessage', (id, user, message) => {
        io.emit('requestMessage', id, user, message)
    })

    socket.on('joinRoom', (id, user) => {
        console.log('An user has joined ' + user + ' room!')

        socket.join(String(user) + String(id))
    })
    socket.on('disconnect', (socket) => {
        console.log('An user has disconnected from the server')
    })
})

server.listen(3000, () => {
    console.log("Request server has started!")
})