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
    // let xhr = new XMLHttpRequest(); 
    // let url = '/gallery/uploads';
    // xhr.open("POST", url, true); 
    // xhr.setRequestHeader("Content-Type", "application/json"); 
    // xhr.onreadystatechange = function () { 
    //     if (xhr.readyState === 4 && xhr.status === 200) { 
    //         result.innerHTML = this.responseText; 
    //     } 
    // }; 
    // var data = JSON.stringify({ data: picture}); 
    // xhr.send(data); 

    fetch('/gallery/uploads', {
    method : 'POST',
    body   : JSON.stringify({data: picture})
    })

    .then((res) => res.text())
    .then((data) => console.log(data))
//     .catch((error) => console.log(error))

}

window.addEventListener('click', startCamera());
document.getElementById("capture-btn").addEventListener("click", takepicture);
form.addEventListener("click", e => {
    e.preventDefault();
    uploadpicture();
});
