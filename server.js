const express = require('express')
const app = express()
const http = require('http')
const server = http.createServer(app)
const io = require('socket.io')(server, {
    cors: { origin: "*" }
})

io.on('connection', (socket) => {
    console.log('An user has connected to the server')

    socket.on('sendMessage', (user, message) => {
        console.log(user)

        socket.emit('requestMessage', user, message)
    })

    socket.on('disconnect', (socket) => {
        console.log('An user has disconnected from the server')
    })
})

server.listen(3000, () => {
    console.log("Request server has started!")
})