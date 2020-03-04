function comparePwd(){
    var form = document.getElementById('resetpwd');
    var str1 = document.getElementById('pwd').value;
    var str2 = document.getElementById('pwd-repeat').value;
    var result = str1.localeCompare(str2);
    if (result == 0){
        form.submit();
    }else{
        alert('password do not match, please retry');
    }
}
