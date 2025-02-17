
loaddata = function (order_id) {
    debugger;
    $.ajax({
        url: "DB/product_in_order/listdata.php", // Gọi file PHP xử lý
        type: "GET",
        data: { orderId: order_id },
        success: function (response) {
            $("#listdata").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
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
            loaddata(id);
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



