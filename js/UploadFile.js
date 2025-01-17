
UploadFile = function(input) {
    // Kiểm tra file
    if (input.files && input.files[0]) {
        let file = input.files[0];
        let formData = new FormData();
        formData.append("file", file);

        // Sử dụng jQuery AJAX
        $.ajax({
            url: 'http://localhost:3000/xampp/htdocs/DATN/UploadFile.php', // URL đến file PHP xử lý
            type: 'POST',
            data: formData,
            contentType: false, // Không đặt Content-Type
            processData: false, // Không xử lý dữ liệu
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                // Theo dõi tiến trình upload
                xhr.upload.addEventListener('progress', function (e) {
                    if (e.lengthComputable) {
                        let percentComplete = Math.round((e.loaded / e.total) * 100);
                        $('#progress-container').show();
                        $('#progress-bar').css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function (response) {
                if (response.success) {
                    alert(response.message); // Hiển thị thành công
                    console.log(response.filePath); // Đường dẫn file đã tải lên
                    $('#imgfile').attr('src', response.filePath); // Hiển thị ảnh
                    $('#progress-bar').css('width', '0%').text('0%'); // Reset tiến trình
                    $('#progress-container').hide();
                } else {
                    alert(response.message); // Hiển thị lỗi
                }           
            },
            error: function () {
                alert('Có lỗi xảy ra khi gửi yêu cầu!');
            }
        });
    } else {
        alert('Vui lòng chọn file!');
    }
}
