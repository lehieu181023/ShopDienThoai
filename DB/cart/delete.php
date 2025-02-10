<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        if($Id > 0){
            $sql = "DELETE FROM `cart` WHERE `id`='$Id'";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            echo "Id không hợp lệ";
        } 
    }
?>