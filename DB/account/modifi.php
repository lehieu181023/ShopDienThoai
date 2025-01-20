<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'];
        $name = $_POST['name'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $status = empty($_POST['status'])?'active':$_POST['status'];
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
        $currentEmail = $db->ArraySelect("SELECT `Email` FROM `accountcustomer` WHERE `id`='$Id'")[0]['Email'];
        if($currentEmail!= $email){
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
        }
        
        // Kiểm tra sđt đã tồn tại chưa
        $currentsdt = $db->ArraySelect("SELECT `SDT` FROM `accountcustomer` WHERE `id`='$Id'")[0]['SDT'];
        if ($currentsdt != $phone){
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
        }

        // Hash mật khẩu    
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "UPDATE `accountcustomer` SET `Name`='$name',`Password`='$pass',`Email`='$email',`SDT`='$phone',`Status`='$status' WHERE `Id`='$Id'";

        $db->ExecuteQuery($sql);
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