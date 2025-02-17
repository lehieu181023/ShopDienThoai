<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        $status = 1;
        if($Id > 0){
            $sql = "UPDATE `contact` SET `Status`= $status WHERE `id`=$Id";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            $response = [
                'success' => false,
                'message' => 'Id không hợp lệ'
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }    
    }
?>