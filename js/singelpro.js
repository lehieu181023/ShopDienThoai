


AddToCart = function (id,quanity) {
    BlockUI(); // Không cho người dùng nhập liệu khi đang thao tác với dữ liệu
    $.ajax({
        url: "DB/cart/add.php",
        type: "POST",
        data: { product_id: id, quantity: quanity },
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


