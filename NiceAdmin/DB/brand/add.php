<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id ;
        $name = $_POST['name']??'';
        $mota = $_POST['mota'] ?? 0;
        $status = $_POST['status'] ?? 0;

        $sql = "INSERT INTO `brand`( `Name`, `Mota`, `Status`) VALUES ('$name','$mota',$status)";

        $response = $db->ExecuteQuery($sql);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>