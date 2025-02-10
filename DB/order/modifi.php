<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include ('../DBcontext.php');
        $Id = $_POST['Id']??0;
        $status = $_POST['status'] ?? 'waiting';
        if($status == 'complete'){
            $now = new DateTime();
            $date = $now->format('Y-m-d H:i:s'); // Định dạng: 2025-01-25 15:30:45
        }
        else{
            $date = null;
        }
        if($Id > 0){
            $sql = "UPDATE `cart` SET `status`='$status',`DayComplete`= '$date' WHERE `id`='$Id'";

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
            exit();
        }
        
    }
?>