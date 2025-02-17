<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include('../DBcontext.php');
        $Id = $_POST['idcart']??0;
        $quanity = $_POST['quanity'] ?? 0;
        if($Id > 0){
            $sql = "UPDATE `cart` SET `quality`='$quanity' WHERE `id`='$Id'";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Id không hợp lệ ' 
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
    }
?>