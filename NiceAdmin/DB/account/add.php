<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id ;
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = $_POST['status'] ?? 0;
        if(empty($name) || empty($pass) || empty($email) || empty($phone)){
            $response = [
                'success' => false,
                'message' => 'Vui lòng nhập đầy đủ thông tin!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit($db->closeConnection());
            exit();
        }
        // Kiểm tra email đã tồn tại chưa
        $sql = "SELECT * FROM `accountcustomer` WHERE `Email`='$email'";
        $data = $db->ArraySelect($sql);
        if(count($data) > 0){
            $response = [
                'success' => false,
                'message' => 'Email đã tồn tại!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit($db->closeConnection());
            exit();
        }
        // Kiểm tra sđt đã tồn tại chưa
        $sql = "SELECT * FROM `accountcustomer` WHERE `SDT`='$phone'";
        $data = $db->ArraySelect($sql);
        if(count($data) > 0){
            $response = [
                'success' => false,
                'message' => 'SĐT đã tồn tại!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit($db->closeConnection());
            exit();
        }
        // Hash mật khẩu    
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `accountcustomer`(`Name`, `Password`, `Email`, `SDT`,`Status`) VALUES ('$name','$hashedPassword','$email','$phone',$status)";

        $response = $db->ExecuteQuery($sql);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Phương thức không hợp lệ'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    $db->closeConnection();
?>