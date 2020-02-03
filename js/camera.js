window.addEventListener('load', startCamera());
document.getElementById("capture-btn").addEventListener("click", takepicture);

function startCamera(){
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            player.srcObject = stream;
            // video.play();
        });
    }
}
function takepicture() {
    var camera = document.getElementById("player");
    var canvas = document.getElementById("canvas").getContext('2d').drawImage(camera, 0, 0, 640 , 480);
    var data = canvas.toDataURL('image/png');
    // document.getElementById('photo').setAttribute('src', data);
}

// const screenshotButton = document.querySelector('#capture-btn');
// screenshotButton.onclick  = function() {
//     // canvas.width = video.videoWidth;
//     // canvas.height = video.videoHeight;
//     canvas.getContext('2d').drawImage(player, 0, 0, 640, 480);
//     // Other browsers will fall back to image/png
//     img.src = canvas.toDataURL('image/png');
// };