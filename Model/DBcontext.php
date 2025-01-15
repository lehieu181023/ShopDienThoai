<?php
class DBcontext {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "dienthoai";

    // Thuộc tính để lưu đối tượng kết nối
    private $connect;

    // Hàm khởi tạo
    public function __construct() {
        // Kết nối cơ sở dữ liệu
        $this->connect = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    // Phương thức kiểm tra kết nối
    public function connection() {
        // Kiểm tra kết nối
        if ($this->connect->connect_error) {
            die("Kết nối thất bại: " . $this->connect->connect_error);
        }
        echo "Kết nối thành công!";
    }

    // Phương thức đóng kết nối
    public function closeConnection() {
        $this->connect->close();
    }

    public function ArraySelect($sql){
        // Mở kết nối
        $this->connection();
        // Truy vấn lấy tất cả 
        $result = $this->connect->query($sql);

        // Khai báo mảng 2 chiều để chứa kết quả
        $data = [];
        
        // Kiểm tra số dòng kết quả trả về
        if (mysqli_num_rows($result) > 0) {
            // Duyệt qua các dòng kết quả
            while ($row = mysqli_fetch_assoc($result)) {
                // Thêm mỗi dòng dữ liệu vào mảng 2 chiều
                $data[] = $row;
            }
        } else {
            echo "Không có kết quả!";
        }
        // Đóng kết nối
        $this->closeConnection();
        
        // Trả về kết quả
        return $data;      
    }
}

    // Tạo đối tượng và kiểm tra kết nối
    $db = new DBcontext();
?>

