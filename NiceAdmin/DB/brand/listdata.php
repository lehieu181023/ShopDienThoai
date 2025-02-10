<?php 
    include ('../DBcontext.php');
    $sql = "SELECT * FROM `brand`";
    $data = $db->ArraySelect($sql);
    $db->closeConnection();
?>
<table class="table" >
    <thead>
        <tr>
        <th>
            Brand_id
        </th>
        <th>Name</th>
        <th>Description</th>
        <th data-type="date" data-format="YYYY/DD/MM">Create Day</th>
        <th>Status</th>
        <th>Operate</th>
        </tr>
    </thead>
    <tbody >
        <?php foreach($data as $item){ ?>
        <tr>
            <td>
                <?php echo $item['id'] ?>
            </td>
            <td>
                <?php echo $item['Name'] ?>
            </td>
            <td>
                <?php echo $item['Mota'] ?>
            </td>
            <td>
                <?php echo $item['CreateDay'] ?>
            </td>
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
                <button type="button" class="btn btn-success" id="viewButton">
                <i class="bi bi-eye"></i> Xem
                </button>                  
                <!-- Nút Sửa -->
                <button type="button" class="btn btn-warning text-white" id="editButton" onclick="editData(<?php echo $item['id'] ?>)">
                <i class="bi bi-pencil"></i> Sửa
                </button>                  
                <!-- Nút Xóa -->
                <button type="button" class="btn btn-danger" id="deleteButton" onclick="deleteData(<?php echo $item['id'] ?>)">
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