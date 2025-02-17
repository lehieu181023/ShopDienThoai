
loaddata = function (){
    $.ajax({
        url: "DB/contact/listdata.php", // Gọi file PHP xử lý
        type: "GET",
        success: function (response) {
            $("#listdata").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}

loaddata();
