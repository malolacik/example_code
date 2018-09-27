

var socket = require('socket.io'),
    express = require('express'),
    https = require('https'),
    http = require('http'),
    fs = require('fs'),
    logger = require('winston');


logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, {colorize: true, timestamp: true});

logger.info('SocketIO > listening on port');


// HTTPS
var app = express();

var https_server = https.createServer({
    key: fs.readFileSync('my_key.key'),
    cert: fs.readFileSync('my_cert.crt')
}, app).listen(3001);



function emitNewOrder(http_server) {
    var io = socket.listen(http_server);

    io.sockets.on('connection', function (socket) {
        // console.log('a user connected');
        // socket.on('disconnect', function () {
        //     console.log('user disconnected');
        // });


        socket.on("message", function (data) {
            var response = JSON.parse(data);
            var message = response.message;
            if(message.length <= 250 && response.x == response.user_id){
                io.emit("message", data);
            }
        });

    });
}



emitNewOrder(https_server);


