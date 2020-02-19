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
    var stickercnv = document.getElementById("canvas2");
    document.getElementById("canvas").getContext('2d').drawImage(camera, 0, 0, 640 , 480);
    document.getElementById("canvas").getContext('2d').drawImage(stickercnv, 0, 0, 640 , 480);

    // document.getElementById('photo').setAttribute('src', data);
    // camera.srcObject.getVideoTracks().forEach((track) => {
        // track.stop(); 
    // });
}


function uploadpicture(){
    let picture = document.getElementById("canvas").toDataURL('image/png');
    fetch('/gallery/take_photo/uploads', {
    method : 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body   : JSON.stringify({data: picture})
    })
    .then((res) => res.json())
    .catch((error) => console.log('error:', error))

}

window.addEventListener('load', startCamera);
document.getElementById("capture-btn").addEventListener("click", takepicture);

const uploadbtn = document.getElementById('upload-btn');

uploadbtn.addEventListener("click", e => {
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
        alert('Take a photo first!');
    }
});

function addsticker1(){
    const contxt = document.getElementById("canvas2").getContext('2d');
    const img = new Image();
    img.src = '/uploads/sticker/flower-1.png';
    img.addEventListener("load", ()=>{
        contxt.drawImage(img, 0, 0, 150, 150);
    })
}
function addsticker2(){
    const contxt = document.getElementById("canvas2").getContext('2d');
    const img = new Image();
    img.src = '/uploads/sticker/flower-2.png';
    img.addEventListener("load", ()=>{
        contxt.drawImage(img, 40, 60, 150, 150);
    })
}
function addsticker3(){
    const contxt = document.getElementById("canvas2").getContext('2d');
    const img = new Image();
    img.src = '/uploads/sticker/vintage-1.png';
    img.addEventListener("load", ()=>{
        contxt.drawImage(img, 200, 300, 150, 150);
    })
}
document.getElementById('1').addEventListener("click", e => {
    e.preventDefault();
    addsticker1();
});
document.getElementById('2').addEventListener("click", e => {
    e.preventDefault();
    addsticker2();
});
document.getElementById('3').addEventListener("click", e => {
    e.preventDefault();
    addsticker3();
});