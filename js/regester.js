

successAction = function (res){
    if (res.success){
        UnBlockUI();
        alert(res.message);
        window.location.href = "login.html";
    }
    else {
        UnBlockUI();
        alert(res.message);
    }  
}
