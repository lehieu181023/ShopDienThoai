

successAction = function (res){
    if (res.success){
        UnBlockUI();
        alert(res.message);
        window.location.reload();
    }
    else {
        UnBlockUI();
        alert(res.message);
    }  
}
