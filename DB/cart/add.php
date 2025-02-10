<?php
    session_start();
    if (isset($_SESSION['account'])) {
        // Lấy thông tin tài khoản hiện tại
       
        $account = $_SESSION['account'];
        include ('../DBcontext.php');
        $sql = "SELECT * FROM `accountcustomer` WHERE `SDT` = '$account' OR `Email` = '$account'";
        $data = $db->ArraySelect($sql);
        if(count($data) > 0){
            $account_id = $data[0]['id'];
        }
        else{
            $response = [
                'success' => false,
                'message' => 'tài khoản không tồn tại'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Vui lòng đăng nhập!'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id ;
        $product_id = $_POST['product_id'] ?? 0;
        $quantity = $_POST['quantity'] ?? 0;

        $sql = "INSERT INTO `cart`(`account_id`, `product_id`, `quality`) VALUES ('$account_id','$product_id',$quantity)";

        $response = $db->ExecuteQuery($sql);
        if($response['success']){
            $response['message'] = 'Thêm giỏ hàng thành công!';
        }
        else{
            $response['message'] = 'Thêm giỏ hàng thất bại!';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>