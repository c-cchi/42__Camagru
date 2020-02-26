function startCamera(){
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
            document.getElementById("player").srcObject = stream;
        }).catch(function(err) {
            console.log(err);
        });
    }
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

function clearcnv(){
    const stickercnv = document.getElementById("canvas2").getContext('2d');
    stickercnv.clearRect(0, 0, 640, 480);
}

function check_cnv1(){
    const ctx1 = document.getElementById("canvas1").getContext('2d');
    const check = ctx1.getImageData(0,0,640,480);
    var len = check.data.length;

    for(var i = 0; i < len; i++) {
        if(!check.data[i]) {
        }else if(check.data[i]) {
            return (true);
        }
    }
    return (false);
}

window.addEventListener('load', startCamera);

document.getElementById('clearcnv').addEventListener("click", e => {
    e.preventDefault();
    clearcnv();
});

document.getElementById("capture-btn").addEventListener("click",  e => {
    e.preventDefault();
    var camera = document.getElementById("player");
    var stickercnv = document.getElementById("canvas2");
    const ctx = document.getElementById("canvas2").getContext('2d');
    const check = ctx.getImageData(0,0,640,480);
    const ctx1 = document.getElementById("canvas1");

    var len = check.data.length;
    for(var i = 0; i < len; i++) {
        if(!check.data[i]) {
            drawn = false;
        }else if(check.data[i]) {
            drawn = true;
            break;
        }
    }
    if (drawn == true){
        if (check_cnv1()){
            document.getElementById("canvas").getContext('2d').drawImage(ctx1, 0, 0, 640 , 480);
        }else{
            document.getElementById("canvas").getContext('2d').drawImage(camera, 0, 0, 640 , 480);
        }
        document.getElementById("canvas").getContext('2d').drawImage(stickercnv, 0, 0, 640 , 480);
    }else{
        alert('Choose a sticker first!');
    }
});

document.getElementById("uplphoto").addEventListener("change", e =>{
    e.preventDefault();
    var url = URL.createObjectURL(e.target.files[0]);
    var img = new Image();
    img.src = url;
    img.addEventListener('load', ()=>{
        document.getElementById('canvas1').getContext('2d').drawImage(img, 0, 0, 640, 480); 
    })
})


const uploadbtn = document.getElementById('upload-btn');

uploadbtn.addEventListener("click", e => {
    e.preventDefault();
    const ctx = document.getElementById("canvas").getContext('2d');
    const check = ctx.getImageData(0,0,640,480);

    var len = check.data.length;
    for(var i = 0; i < len; i++) {
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