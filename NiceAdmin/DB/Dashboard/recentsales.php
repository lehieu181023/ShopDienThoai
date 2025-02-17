<?php
    include('../DBcontext.php');
    $sql = "SELECT `total`, `address`,  `FullName`, id ,`status` FROM `order` ORDER by DayCreate DESC LIMIT 5";
    $data = $db->ArraySelect($sql);
?>
<div class="col-12">
    <div class="card recent-sales overflow-auto " style="min-height: 18vw;">

    <div class="card-body">
        <h5 class="card-title">Recent Sales <span></span></h5>

        <table class="table table-borderless datatable">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Customer</th>
            <th scope="col">Address</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item) {?>
            <tr>
            <th scope="row"><a href="product_in_order.php?orderId=<?php echo $item['id'] ?>">#<?php echo $item['id'] ?></a></th>
            <td><?php echo $item['FullName'] ?></td>
            <td><Address><?php echo $item['address'] ?></Address></td>
            <td><?php echo $formatted_quantity = number_format($item['total'], 0, '', ','); ?> VND</td>
            <td>
                <?php 
                    switch ($item['status']) {
                        case 'waiting':
                            echo '<span class="badge bg-warning">waiting</span></td>';
                            break;
                        case 'pending':
                            echo '<span class="badge bg-primary">pending</span></td>';
                            break;
                        case 'completed':
                            echo '<span class="badge bg-success">Completed</span></td>';
                            break;
                        case 'cancelled':
                            echo '<span class="badge bg-danger">Cancelled</span></td>';
                            break;
                        default:
                            echo '<span class="badge bg-secondary">Unknown</span></td>';
                            break;
                    }
                
                ?>
            </tr>
            <?php } ?>

        </tbody>
        </table>

    </div>

    </div>
</div>