<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['Id']??0;
        $quanity = $_POST['quanity'] ?? 0;
        if($Id > 0){
            $sql = "UPDATE `cart` SET `quality`='$quanity' WHERE `id`='$Id'";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            echo "Id không hợp lệ";
        }
        
    }
?>