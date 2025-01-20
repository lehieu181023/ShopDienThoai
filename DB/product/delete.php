<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id = $_POST['id'] ?? 0;
        if($Id > 0){
            $sql = "DELETE FROM `product` WHERE `id`='$Id'";

            $db->ExecuteQuery($sql);
        }
        else{
            echo "Id không hợp lệ";
        } 
    }
?>