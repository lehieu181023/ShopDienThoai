
customercard = function (filter){
    $.ajax({
        url: "DB/Dashboard/customercard.php", // Gọi file PHP xử lý
        type: "GET",
        data: {filter: filter}, // Gửi tham số filter đến file PHP
        success: function (response) {
            $("#customer-card").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
recentsales = function (){
    $.ajax({
        url: "DB/Dashboard/recentsales.php", // Gọi file PHP xử lý
        type: "GET",
        success: function (response) {
            $("#recentSales").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
report = function (){
    $.ajax({
        url: "DB/Dashboard/report.php", // Gọi file PHP xử lý
        type: "GET",
        success: function (response) {
            $("#report").html(response); // Chèn dữ liệu vào bảng
            gen();
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
revenuecard = function (filter){
    $.ajax({
        url: "DB/Dashboard/revenuecard.php", // Gọi file PHP xử lý
        type: "GET",
        data: {filter: filter}, // Gửi tham số filter đến file PHP
        success: function (response) {
            $("#revenue-card").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
salecard = function (filter){
    $.ajax({
        url: "DB/Dashboard/salecard.php", // Gọi file PHP xử lý
        type: "GET",
        data: {filter: filter}, // Gửi tham số filter đến file PHP
        success: function (response) {
            $("#sales-card").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
TopSelling = function (filter){
    $.ajax({
        url: "DB/Dashboard/TopSelling.php", // Gọi file PHP xử lý
        type: "GET",
        data: {filter: filter}, // Gửi tham số filter đến file PHP
        success: function (response) {
            $("#topSelling").html(response); // Chèn dữ liệu vào bảng
        },
        error: function () {
            alert("Không thể tải dữ liệu!");
        }
    });
}
customercard();

recentsales();

revenuecard();

salecard();

TopSelling();

// Thêm các hàm tương tự cho các bảng khác


