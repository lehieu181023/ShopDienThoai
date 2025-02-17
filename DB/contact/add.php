<?php
    include ('../DBcontext.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = "INSERT INTO `contact`(`fullname`, `Email`, `Subject`, `Message`) VALUES ('$fullname','$email','$subject','$message')";

        $response = $db->ExecuteQuery($sql);
        if ($response['success'] === true) {
            $response['message'] = 'Message sent successfully!';
        } else {
            $response['message'] = 'Error sending message. Please try again later.';
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>