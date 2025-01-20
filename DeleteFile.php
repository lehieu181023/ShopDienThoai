<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra nếu file được gửi
    $filePath = $_POST['filePath'];

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            $response = [
                'success' => true,
                'message' => 'Xóa file thành công!',
                'filePath' => $filePath
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'không thể xóa file!'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'File không tồn tại!'
        ];
    }
    
} else {
    $response = [
        'success' => false,
        'message' => 'Yêu cầu không hợp lệ!'
    ];
}

// Trả về JSON
header('Content-Type: application/json');
echo json_encode($response);

?>

