<?php 
    include ('../DBcontext.php');
    $dataBrands = $db->ArraySelect("SELECT * FROM `brand` WHERE `Status` = 1");
    $sql = "SELECT * FROM `product` order by CreateDay desc";
    $data = $db->ArraySelect($sql);
    $db->closeConnection();  
?>
<table class="table">
<thead>
    <tr>
    <th>STT</th>
    <th>Img</th>
    <th>Name</th>
    <th>Brand</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Quantity sold</th>
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
    <td class="img-product"><img  src="<?php echo $item['Image'] ?>" alt="" width="100px" height="100px"></td>
    <td><?php echo $item['Name']?></td>
    <td><?php 
    $index = array_search($item['Brands'], array_column($dataBrands, "id"));
    echo $dataBrands[$index]['Name'];
    ?></td>
    <td><?php echo $item['Price']?></td>
    <td><?php echo $item['quantity']?></td>
    <td><?php echo $item['QuantitySold']?></td>
    <td><?php echo $item['CreateDay'] ?></td>
    <td>
    <?php
        echo $item['Status'] 
        ?>
    </td>
    <td>                          
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