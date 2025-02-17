<?php 
    include ('../DBcontext.php');
    $sql = "SELECT * FROM `order` order by DayCreate desc";
    $data = $db->ArraySelect($sql);
    $dataEnum = $db->ArrayEnum('order','status');
    $db->closeConnection();  
?>
<table class="table">
<thead>
    <tr>
    <th>STT</th>
    <th>Id</th>
    <th>Total</th>
    <th>Address</th>
    <th>Country</th>
    <th>FullName</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Town/ City</th>
    <th data-type="date" data-format="YYYY/DD/MM">Start Date</th>
    <th data-type="date" data-format="YYYY/DD/MM">Date Complete</th>
    <th>StatusOrder</th>
    <th>Operate</th>
    </tr>
</thead>
<tbody>
<?php
 $stt = 1;
 foreach($data as $item){ ?>
    <tr>
    <td><?php echo $stt++ ?></td>
    <td><?php echo $item['id']?></td>
    <td><?php echo $item['total']?></td>
    <td><?php echo $item['address']?></td>
    <td><?php echo $item['Country']?></td>
    <td><?php echo $item['FullName']?></td>
    <td><?php echo $item['Phone']?></td>
    <td><?php echo $item['EmailAddress']?></td>
    <td><?php echo $item['TownCity']?></td>
    <td><?php echo $item['DayCreate'] ?></td>
    <td><?php echo $item['DayComplete'] ?></td>
    <td>
      <select class="form-select" aria-label="Default select example" name="status" onchange="editStatus(<?php echo $item['id'] ?>,this.value)">
      <?php
        foreach($dataEnum as $itemenum){
      ?>
        <option value="<?php echo $itemenum ?>" <?php echo ($itemenum === $item['status'])?' selected':''?>><?php echo $itemenum ?></option>
      <?php }?>
      </select>
    </td>  <!-- Trạng thái đơn hàng -->  <!-- Nút Xem -->
    <td>           
        <a type="button" class="btn btn-success mb-3" id="viewButton" href="product_in_order.php?orderId=<?php echo $item['id'] ?>">
        <i class="bi bi-eye"></i> Xem
        </a>                  
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