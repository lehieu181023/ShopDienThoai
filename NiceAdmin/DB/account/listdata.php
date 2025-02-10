<?php 
    include ('../DBcontext.php');
    $sql = "SELECT * FROM `accountcustomer` order by CreateDay desc";
    $data = $db->ArraySelect($sql);
    $db->closeConnection();  
?>
<table class="table">
<thead>
    <tr>
    <th>STT</th>
    <th>Name</th>
    <th>Email</th>
    <th>SDT</th>
    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
    <th>Status</th>
    <th>Operate</th>
    </tr>
</thead>
<tbody>
<?php
 $stt = 1;
 foreach($data as $item){ ?>
    <tr>
    <td><?php echo $stt++ ?></td>
    <td><?php echo $item['Name']?></td>
    <td><?php echo $item['Email']?></td>
    <td><?php echo $item['SDT'] ?></td>
    <td><?php echo $item['CreateDay'] ?></td>
    <td>
    <?php
    if($item['Status']){
        echo '<button type="button" class="btn btn-primary" id="primaryButton" onclick="editStatus('.$item['id'].',0)">Hoạt động</button>';
    }
    else{
        echo '<button type="button" class="btn btn-danger" id="primaryButton" onclick="editStatus('.$item['id'].',1)">Khóa</button>';
    }
    ?>
    </td>
    <td>           
        <button type="button" class="btn btn-success mb-3" id="viewButton">
        <i class="bi bi-eye"></i> Xem
        </button>                  
        <!-- Nút Sửa -->
        <button type="button" class="btn btn-warning text-white mb-3" id="editButton" onclick="editData(<?php echo $item['id'] ?>)">
        <i class="bi bi-pencil"></i> Sửa
        </button>                  
        <!-- Nút Xóa -->
        <button type="button" class="btn btn-danger mb-3" id="deleteButton"  onclick="deleteData(<?php echo $item['id'] ?>)">
        <i class="bi bi-trash"></i> Xóa
        </button>
    </td>
    </tr> 
<?php } ?> 
</tbody>
</table>
  <!-- DataTables JS Script -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('table').DataTable({
        "pageLength": 10,  // Số dòng mỗi trang
        "lengthChange": false, // Không cho phép thay đổi số lượng dòng
        "searching": false,  // Tắt thanh tìm kiếm
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