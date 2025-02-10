genModalAdd = function(path){
    debugger;
    $.get(path, function(data) {
        $("#target-div").html(data); // Chèn nội dung HTML vào div
        $("#myModal").modal("show"); // Hiện modal
      }).fail(function() {
        $("#target-div").html("<p>Error loading content.</p>");
      });
}
closeModal = function(){
    $("#target-div").html(''); // Xóa nội dung HTML của div
}