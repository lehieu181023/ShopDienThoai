<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Kiểm tra nếu file được gửi
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];

        // Thông tin file
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Đường dẫn lưu file
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $uploadPath = $uploadDir . basename($fileName);

        // Kiểm tra loại file (ví dụ: chỉ cho phép ảnh)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($fileType, $allowedTypes)) {
            // Di chuyển file tải lên vào thư mục đích
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                $response = [
                    'success' => true,
                    'message' => 'Tải file thành công!',
                    'filePath' => $uploadPath
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Không thể di chuyển file!'
                ];
            }
        } else {
            $response = [
                'success' => false,
                'message' => 'Chỉ cho phép các loại file: JPEG, PNG, GIF!'
            ];
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Không có file được tải lên hoặc có lỗi!'
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

