loaddataInShopPage = function (page){
    $.ajax({
        url: "DB/product/listdata.php", // Gọi file PHP xử lý
        type: "GET",
        data: { page : page},
        success: function (response) {
            $("#listdata").html(response); // Chèn dữ liệu vào bảng
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            
            if (response.success == false) {
                alert(response.message);
            }
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
loaddataInShopPage(1);