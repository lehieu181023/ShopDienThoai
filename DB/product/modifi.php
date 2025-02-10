<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        $name = $_POST['name']?? '';
        $brands = $_POST['brands'] ?? 0;
        $image = $_POST['image'] ?? '';
        $price = $_POST['price'] ?? 0;
        $status = $_POST['status'] ?? "OnSale";
        $quanity = $_POST['quanity'] ?? 0;
        if($Id > 0){
            $sql = "UPDATE `product` SET `Name`='$name',`Brands`='$brands',`Image`='$image',`Price`='$price',`Status`='$status',`quantity`='$quanity' WHERE `id`='$Id'";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            echo "Id không hợp lệ";
        }
        
        
    }
?>