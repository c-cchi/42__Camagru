window.addEventListener('load', startCamera());

var video = document.getElementById('player');

function startCamera(){
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            player.srcObject = stream;
            video.play();
        });
    }
}

// navigator.getMedia = ( navigator.getUserMedia ||
//     navigator.webkitGetUserMedia ||
//     navigator.mozGetUserMedia ||
//     navigator.msGetUserMedia);

// navigator.getMedia(
//     {video: true},
//     function(stream) {
//         if (navigator.mozGetUserMedia) {
//         video.mozSrcObject = stream;
//         } else {
//         var vendorURL = window.URL || window.webkitURL;
//         video.src = vendorURL.createObjectURL(stream);
//         }
//         video.srcObject = stream;
//         video.play();
//     },  
//     function(err) {
//         console.log("An error occured! " + err);
// });
