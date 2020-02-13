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
    // camera.srcObject.getVideoTracks().forEach((track) => {
        // track.stop(); 
    // });
}

const form = document.querySelector('#uploadform');

function uploadpicture(){
    let picture = document.getElementById("canvas").toDataURL('image/png');
    fetch('/gallery/uploads', {
    method : 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body   : JSON.stringify({data: picture})
    })
    .then((res) => res.json())
    // .then((data) => console.log(data))
    .catch((error) => console.log('error:', error))

}

window.addEventListener('click', startCamera());
document.getElementById("capture-btn").addEventListener("click", takepicture);
form.addEventListener("click", e => {
    e.preventDefault();
    const ctx = document.getElementById("canvas").getContext('2d');
    const check = ctx.getImageData(0,0,640,480);
    var len = check.data.length;
    for(var i =0; i< len; i++) {
        if(!check.data[i]) {
            drawn = false;
        }else if(check.data[i]) {
            drawn = true;
            break;
        }
    }
    if (drawn == true){
        uploadpicture();
        ctx.clearRect(0, 0, 640, 480);
    }else{
        alert('Take a picture first!');
    }
});
