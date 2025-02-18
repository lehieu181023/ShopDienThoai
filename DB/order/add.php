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
        $address = $_POST['address'] ?? '';
        $country = $_POST['country'] ?? '';
        $city = $_POST['city'] ?? '';
        $postcode = $_POST['postcode'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $fullname = $_POST['fullname'] ?? ''; 
        $sql = "SELECT 
                    cart.product_id, 
                    cart.quality,
                    product.quantity as product_quality,
                    product.price 
                FROM 
                    cart
                INNER JOIN 
                    product 
                ON 
                    cart.product_id = product.id;";
        $dataCart = $db->ArraySelect($sql);
        if(count($dataCart) <= 0){
            $response = [
                'success' => false,
                'message' => 'Giỏ hàng trống!'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        else{
            foreach ($dataCart as $row) {
                if($row['quality'] > $row['product_quality']){
                    $response = [
                        'success' => false,
                        'message' => 'Số lượng sản phẩm không đủ!'
                    ];
                    header('Content-Type: application/json');
                    echo json_encode($response);
                    exit();
                }
            }
        }
        $total = 0;
        foreach ($dataCart as $row) {
            $quantity = $row['quality'];
            $price = $row['price'];
            $total += $quantity * $price;
        }
        // Tạo mã đơn hàng
        $sql = "INSERT INTO `order`( `account_id`, `total`, `address`, `Country`, `FullName`, `TownCity`, `Postcode`, `EmailAddress`, `Phone`) VALUES ('$account_id','$total','$address','$country','$fullname','$city','$postcode','$email','$phone');";
        $response = $data = $db->ExecuteQuery($sql);

        // Thêm chi tiết đơn hàng
        $sql = "INSERT INTO `product_in_order`(`idproduct`, `quantity`, `idorder`) 
                SELECT 
                    product_id,
                    quality,
                    LAST_INSERT_ID() AS idorder
                FROM cart
                WHERE account_id = $account_id;
                ";
        $response = $db->ExecuteQuery($sql);
        // Cập nhật số lượng sản phẩm trong kho
        $sql = "UPDATE product p
                JOIN cart c ON p.id = c.product_id
                SET p.quantity = p.quantity - c.quality, 
                    p.QuantitySold = p.QuantitySold + c.quality
                WHERE c.account_id = $account_id;
                ";
        $response = $db->ExecuteQuery($sql);
        // Xóa giỏ hàng
        $sql = "DELETE FROM cart WHERE account_id = $account_id;";
        $response = $db->ExecuteQuery($sql);
        echo "<script>alert('Tạo đơn hàng thành công!')
                window.location.href = '../../index.php';
                </script>";
    }
?>