<?php
    $idOrder = $_GET['orderId']??0;
    if($idOrder <= 0){
      $response = [
        'success' => false,
        'message' => 'id order không hợp lệ!'
      ];  
      header('Content-Type: application/json');
      echo json_encode($response);
      exit();
    }
    include ('../DBcontext.php');
    $sql = "SELECT p.Image, p.Name as nameproduct,b.Name as NameBrand ,p.Price, pio.quantity, (p.Price * pio.quantity) as total  FROM product_in_order pio 
                  JOIN `order` o ON o.id = pio.idorder 
                  JOIN product p ON p.id = pio.idproduct
                  JOIN brand b ON p.Brands = b.id
                  WHERE o.id = $idOrder";
    $data = $db->ArraySelect($sql);
    $dataone = $db->OneSelect("select `status` from `order` where id = $idOrder");
    $dataEnum = $db->ArrayEnum('order','status');
    $db->closeConnection();
  ?>
<select style="width: auto;" class="form-select mb-3" aria-label="Default select example" name="status" onchange="editStatus(<?php echo $idOrder ?>,this.value)">
      <?php
        foreach($dataEnum as $itemenum){
      ?>
        <option value="<?php echo $itemenum ?>" <?php echo ($itemenum === $dataone['status'])?' selected':''?>><?php echo $itemenum ?></option>
      <?php }?>
</select>
<table class="table">
  <thead>
      <tr>
      <th>STT</th>
      <th>Img</th>
      <th>Name</th>
      <th>Brand</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total</th>
      </tr>
  </thead>
  <tbody>
  <?php
  $stt = 1;
  foreach($data as $item){ ?>
      <tr>
      <td><?php echo $stt++ ?></td>
      <td><img src="<?php echo $item['Image']?>" alt="<?php echo $item['nameproduct']?>" width="50px" height="50px"></td>
      <td><?php echo $item['nameproduct']?></td>
      <td><?php echo $item['NameBrand']?></td>
      <td><?php echo number_format($item['Price'], 0, '', '.')?> đ</td>
      <td><?php echo $item['quantity']?></td>
      <td><?php echo number_format($item['total'], 0, '', '.')?> đ</td>
      </tr> 
  <?php } ?> 
  </tbody>
</table>
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