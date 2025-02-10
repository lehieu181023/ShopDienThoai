<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Id ;
        $name = $_POST['name']??'';
        $brands = $_POST['brands'] ?? 0;
        $image = $_POST['imgproduct'] ?? '';
        $price = $_POST['price'] ?? 0;
        $status = $_POST['status'] ?? "OnSale";
        $quanity = $_POST['quanity'] ?? 0;

        $sql = "INSERT INTO `product`( `Name`, `Brands`, `Image`, `Price`, `Status`,  `quantity`) VALUES ('$name','$brands','$image','$price','$status','$quanity')";
        $response = $db->ExecuteQuery($sql);
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>