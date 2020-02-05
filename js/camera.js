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
}

function uploadpicture(){
    var dataUrl = document.getElementById("canvas").toDataURL();
    var img_src = dataUrl.src;
    fetch('../uploads/upload.php', {
    method : 'post',
    body   : JSON.stringify({data: dataUrl})
    })
    .then((res) => res.json())
    // .then((data) => console.log(data))
    // .catch((error) => console.log(error))
}
window.addEventListener('load', startCamera());
document.getElementById("capture-btn").addEventListener("click", takepicture);
document.getElementById("upload-btn").addEventListener("click", uploadpicture);
