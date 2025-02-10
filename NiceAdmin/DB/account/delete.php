<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        if($Id > 0){
            $sql = "DELETE FROM `accountcustomer` WHERE `id`=$Id";
            $response = $db->ExecuteQuery($sql);

        }
        else{
            $response = [
                'success' => false,
                'message' => 'id không hợp lệ'
            ];
            
        } 
    }
    else{
        $response = [
            'success' => false,
            'message' => 'Phương thức không hợp lệ'
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    $db->closeConnection();
?>