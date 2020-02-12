function noEmptyFields(){
    var uid = document.forms['modify']['uid'].value;
    var pwd = document.forms['modify']['pwd'].value;
    var email = document.forms['modify']['email'].value;
    var oldpwd = document.forms['modify']['oldpwd'].value;
    var pwrp = document.forms['modify']['pwdrepeat'].value;
    if ((pwd == "") || (email == "") || (oldpwd == "") || (uid == "") || (pwrp == "")){
        alert("Empty Fields");
    }else{
        document.forms['modify'].submit();
    }
}