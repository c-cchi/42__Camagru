function escapeHtml(unsafe) {
    return unsafe
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}

document.getElementById('delete').forEach(item => {
    item.addEventListener('click', event => {
        
        console.log(item);
    })
})

// function deletecmmt(){
//     console.log('click');
// }

// document.getElementById('delete').addEventListener('click', deletecmmt);
