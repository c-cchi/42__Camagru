function comparePwd(){
    var form = document.querySelector('.signup');
    var str1 = form.querySelector('input[name="pwd"]').value;
    var str2 = form.querySelector('input[name="pwd-repeat"]').value;
    var result = str1.localeCompare(str2);
    if (result == 0){
        form.submit();
    }else{
        alert('password do not match, please retry');
    }
}