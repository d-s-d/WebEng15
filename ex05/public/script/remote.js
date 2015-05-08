var currentImage = 0; // the currently selected image
var imageCount = 7; // the maximum number of images available
var socket;

function showImage (index){
    // Update selection on remote
    currentImage = index;
    var images = document.querySelectorAll("img");
    document.querySelector("img.selected").classList.toggle("selected");
    images[index].classList.toggle("selected");

    // Send the command to the screen
    socket.emit('select', {index: index});
}

function clearNode(node) {
	while(node.hasChildNodes())
	{
		node.removeChild(node.firstChild);
	}
}

var screens = [];

function emitAttachEvent(eventName, screenName) {
	socket.emit(eventName, {screenName: screenName});
}

function updateScreens(screenList) {
	screens = screenList;
	var listNode = document.querySelector("#menuList");
	clearNode(listNode);
	for(var i in screenList) {
		var liScreen = document.createElement("li");
		var pScreenName = document.createElement("p");
		var screen = screenList[i];
		pScreenName.textContent = screen.screenName;
		btnAttach = document.createElement("button");
		btnAttach.textContent = screen.attached ? "Disconnect" : "Connect";
		btnAttach.addEventListener("click", (
			function(screen, btn) {
				return function(event) {
					if( screen.attached === true ) {
						btn.textContent = "Connect";
						emitAttachEvent("detatch", screen.screenName);
						// 
					} else {
						btn.textContent = "Disconnect";
						emitAttachEvent("attach", screen.screenName);
					}
					screen.attached = !screen.attached;
				}			
		})(screen, btnAttach));
		liScreen.appendChild(pScreenName);
		liScreen.appendChild(btnAttach);
		listNode.appendChild(liScreen);
	}
}

function initialiseGallery(){
    var container = document.querySelector('#gallery');
    var i, img;
    for (i = 0; i < imageCount; i++) {
        img = document.createElement("img");
        img.src = "images/" +i +".jpg";
        document.body.appendChild(img);
        var handler = (function(index) {
            return function() {
                showImage(index);
            }
        })(i);
        img.addEventListener("click",handler);
    }

    document.querySelector("img").classList.toggle('selected');
}

document.addEventListener("DOMContentLoaded", function(event) {
    initialiseGallery();

    document.querySelector('#toggleMenu').addEventListener("click", function(event){
        var style = document.querySelector('#menu').style;
        style.display = style.display == "none" || style.display == ""  ? "block" : "none";
    });
    connectToServer();
});

function connectToServer(){
    // TODO connect to the socket.io server
		socket = io.connect('http://localhost:8080');
		socket.emit('registerRemote', {});

		socket.on('updateScreenList', function(data) {
			updateScreens(data.screens);
		});
}
