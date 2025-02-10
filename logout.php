<?php
session_start();
unset($_SESSION['account']); // Xóa session 
unset($_SESSION['pass']); // Xóa session 

header("Location: index.php"); // Quay lại trang đăng nhập
exit();
?>
