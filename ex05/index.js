var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.use(express.static('public'));

http.listen(8080, function(){
    console.log('listening on *:8080');
});

var remote;
var screens = [];

function findScreen(screenName) {
	for( var i in screens )
	{
		var screen = screens[i];
		if( screen.screenName === screenName )
		{
			return screen;
		}
	}
}

function findScreenIndexBySocket(socket) {
	for( var i in screens )
	{
		var screen = screens[i];
		if( screen.socket == socket )
			return i;
	}
}

function getScreenList() {
	var list = [];
	for( var i in screens ) {
		var screen = screens[i];
		list.push( {screenName: screen.screenName, attached: screen.attached} );
	}
	return list;
}

function emitRemoteScreenListUpdate() 
{
	if(remote) {
		remote.emit('updateScreenList', {screens: getScreenList()});
	}
}

io.on('connection', function(socket) {
	socket.on('registerRemote', function(data) {
		remote = socket;
		emitRemoteScreenListUpdate();
		console.log('registered remote');
	});

	socket.on('registerScreen', function(data) {
		console.log(data);
		var s = {screenName: data.screenName, socket: socket, attached: false};
		screens.push(s);
		emitRemoteScreenListUpdate();
		console.log('registered screen');
	});

	socket.on('attach', function(data) {
		console.log(data);
		var s = findScreen(data.screenName);
		s.attached = true;
		console.log('attached screen' + s.screenName);
	});

	socket.on('detatch', function(data) {
		console.log(data);
		var s = findScreen(data.screenName);
		s.attached = false;
		console.log('detatched screen ' + s.screenName);
	});

	socket.on('disconnect', function() {
		if( socket !== remote )
		{
			var i = findScreenIndexBySocket(socket);
			delete screens[i];
			emitRemoteScreenListUpdate();
		}
		console.log('disconnection event');
	});
	console.log('connection');
});
