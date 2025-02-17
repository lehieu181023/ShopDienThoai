
loaddata = function (){
    $.ajax({
        url: "DB/order/listdata.php", // Gọi file PHP xử lý
        type: "GET",
        success: function (response) {
            $("#listdata").html(response); // Chèn dữ liệu vào bảng
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

deleteData = function (id) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
        $.ajax({
            url: "DB/product/delete.php",
            type: "POST",
            data: { id: id },
            success: function (res) {
                UnBlockUI();
                loaddata();
                if (res.success){
                    alert(res.message);
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

editData = function (id) {
    BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
    $.ajax({
        url: "formsProduct.php", // Gọi file PHP xử lý
        type: "POST",
        data: { id: id },
        success: function (response) {
            $("#target-div").html(response); // Chèn nội dung HTML vào div
            $("#myModal").modal("show"); // Hiện modal
            UnBlockUI();
        },
        error: function () {
            UnBlockUI();
            alert("Không thể tải dữ liệu!");
        }
    });
}

editStatus = function (id, status) {

    BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
    $.ajax({
        url: "DB/order/editStatus.php",
        type: "POST",
        data: { id: id, status: status },
        success: function (res) {
            UnBlockUI();
            loaddata();
            if (res.success){
                alert(res.message);
            }
            else {
                alert(res.message);
            }     
        },
        error: function () {
            UnBlockUI();
            alert("Không thể thay đổi trạng thái!");
        }
    });
}

loaddata();
