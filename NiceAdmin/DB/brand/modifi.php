<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        $name = $_POST['name']??'';
        $mota = $_POST['mota'] ?? 0;
        $status = $_POST['status'] ?? 0;
        if($Id > 0){
            $sql = "UPDATE `brand` SET `Name`='$name',`Mota`='$mota',`Status`=$status WHERE `id`=$Id";

            $response = $db->ExecuteQuery($sql);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else{
            echo "Id không hợp lệ";
        }    
    }
?>