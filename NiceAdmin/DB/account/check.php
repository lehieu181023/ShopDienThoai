<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $account = $_POST['account'] ?? 0;
        $pass = $_POST['pass'] ?? 0;
        if($account == 0  || $pass == 0){
            $response = [
                'success' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }

        $sql = "SELECT * FROM `accountcustomer` WHERE `Email`='$account'";
        $data = $db->ArraySelect($sql);
        if(count($data) == 0){
            $sql = "SELECT * FROM `accountcustomer` WHERE `SDT`='$account'";
            $data = $db->ArraySelect($sql);   
        }
        if(count($data) > 0){
            $checkUser = $data[0]['Password'];
            if(password_verify($pass, $checkUser)){
                
                session_start(); // Khởi động session

                // Lưu thông tin vào session

                $_SESSION['account'] = $account;
                $_SESSION['pass'] = $checkUser;

                echo "Session được khởi tạo.";

                $response = [
                    'success' => true,
                    'message' => 'Đăng nhập thành công!'
                ];
            }
            else{
                $response = [
                    'success' => false,
                    'message' => 'Mật khẩu không đúng!'
                ];
            }
        }
        else{
            $response = [
                'success' => false,
                'message' => 'tài khoản không tồn tại'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            $db->closeConnection();
            exit();
        }
             
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Phương thức không hợp lệ'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    echo $_SESSION['account'];
    $db->closeConnection();
?>