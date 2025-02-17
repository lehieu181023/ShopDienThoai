<?php 
    include ('../DBcontext.php');
    $sql = "SELECT * FROM `contact` order by CreateDay desc";
    $data = $db->ArraySelect($sql);
    $db->closeConnection();  
?>
<table class="table">
<thead>
    <tr>
    <th>STT</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Subject</th>
    <th>Message</th>
    <th data-type="date" data-format="YYYY/DD/MM">Create Day</th>
    </tr>
</thead>
<tbody>
<?php
 $stt = 1;
 foreach($data as $item){ ?>
    <tr>
      <td><?php echo $stt;?></td>
      <td><?php echo $item['fullname'];?></td>
      <td><?php echo $item['Email'];?></td>
      <td><?php echo $item['Subject'];?></td>
      <td><?php echo $item['Message'];?></td>
      <td><?php echo $item['CreateDay']?></td>
    </tr> 
<?php } ?> 
</tbody>
</table>
  <!-- DataTables JS Script -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable({
        "pageLength": 10,  // Số dòng mỗi trang
        "lengthChange": true, // Không cho phép thay đổi số lượng dòng
        "searching": true,  // Tắt thanh tìm kiếm
        "language": {
          "lengthMenu": "Hiển thị _MENU_ dòng",
          "info": "Hiển thị từ _START_ đến _END_ trong tổng số _TOTAL_ dòng",
          "paginate": {
            "previous": "Trước",
            "next": "Tiếp"
          }
        }
      });
    });
  </script>