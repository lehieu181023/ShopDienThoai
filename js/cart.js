
loaddata = function (){
    $.ajax({
        url: "DB/cart/listdata.php", // Gọi file PHP xử lý
        type: "GET",
        success: function (response) {
            $("#listdata").html(response); // Chèn dữ liệu vào bảng
            if (response.success == false) {
                alert(response.message);
            }
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
successAction = function (res){
    if (res.success){
        UnBlockUI();
        $('#btnclosemodel').click();
        loaddata();
        alert(res.message);
    }
    else {
        UnBlockUI();
        alert(res.message);
    }  
}

AddToCart = function (id) {
    BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
    $.ajax({
        url: "DB/cart/add.php",
        type: "POST",
        data: { product_id: id, quantity: 1 },
        success: function (res) {
            UnBlockUI();   
            if (res.success){
                alert(res.message);
            }
            else {
                alert(res.message);
            }
            LoadHeader();
        },
        error: function () {
            UnBlockUI();
            alert("Không thể thêm sản phẩm vào giỏ hàng!");
        }
    });
}


deleteData = function (id) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
        $.ajax({
            url: "DB/cart/delete.php",
            type: "POST",
            data: { id: id },
            success: function (res) {
                UnBlockUI();
                loaddata();
                if (res.success){
                    
                }
                else {
                    alert(res.message);
                }
   
            },
            error: function () {
                UnBlockUI();
                alert("Không thể xóa dữ liệu!");
            }
        });
    } else {
        console.log("Hủy xóa!");
    }
}

editCart = function (id,quantity) {
    BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
    $.ajax({
        url: "DB/cart/modifi.php",
        type: "POST",
        data: { idcart: id, quanity: quantity },
        success: function (res) {
            UnBlockUI();   
            if (res.success === false){
                alert(res.message);
            }
            loaddata();
        },
        error: function () {
            UnBlockUI();
            alert("Không thay đổi sản phẩm trong giỏ hàng!");
        }
    });
}

