


successAction = function (res){
    if (res.success){
        UnBlockUI();
        alert(res.message);
        window.location.href = "index.php";
    }
    else {
        UnBlockUI();
        alert(res.message);
    }  
}

