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
    document.getElementById("canvas").getContext('2d').drawImage(camera, 0, 0, 640 , 480);
    // document.getElementById('photo').setAttribute('src', data);
    camera.srcObject.getVideoTracks().forEach((track) => {
        // track.stop(); 
    });
}

const form = document.querySelector('form');

function uploadpicture(){
    let picture = document.getElementById("canvas").toDataURL();

    fetch('/gallery/uploads', {
    method : 'POST',
    body   : JSON.stringify({data: picture})
    })
    console.log(JSON.stringify({data: picture}))
    .then((res) => console.log(response))
    // .then((data) => console.log(data))
    // .catch((error) => console.log(error))
}

window.addEventListener('load', startCamera());
document.getElementById("capture-btn").addEventListener("click", takepicture);
form.addEventListener("submit", e => {
    e.preventDefault();
    uploadpicture();
});
