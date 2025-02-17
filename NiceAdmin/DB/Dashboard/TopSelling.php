<?php
    include('../DBcontext.php');
    $filter = $_GET['filter'] ?? 'today';

    $query = "SELECT 
                p.Name, 
                p.Image, 
                p.Price, 
                SUM(po.quantity) AS QuantitySold, 
                SUM(p.Price * po.quantity) AS Revenue
            FROM product p
            JOIN product_in_order po ON p.id = po.idproduct
            JOIN `order` o ON po.idorder = o.id";

    if ($filter == "today") {
        $query .= " WHERE DATE(o.DayCreate) = CURDATE()
                    AND o.status = 'completed'
                    GROUP BY p.id
                    order BY Revenue DESC
                    LIMIT 5;";
        
    } elseif ($filter == "this_month") {
        $query .= " WHERE MONTH(o.DayCreate) = MONTH(CURDATE()) 
                    AND YEAR(o.DayCreate) = YEAR(CURDATE())
                    AND o.status = 'completed'
                    order BY Revenue DESC
                    LIMIT 5
                    ";
    } elseif ($filter == "this_year") {
        $query .= " WHERE YEAR(o.DayCreate) = YEAR(CURDATE())
                    AND o.status = 'completed'
                    order BY Revenue DESC
                    LIMIT 5
                    ";
    }

    $datanow = $db->ArraySelect($query);
?>
<div class="col-12">
    <div class="card top-selling overflow-auto" style="min-height: 18vw;">

    <div class="filter">
        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
            <h6>Filter</h6>
        </li>

        <li><a class="dropdown-item" onclick="TopSelling('today')">Today</a></li>
        <li><a class="dropdown-item" onclick="TopSelling('this_month')">This Month</a></li>
        <li><a class="dropdown-item" onclick="TopSelling('this_year')">This Year</a></li>
        </ul>
    </div>

    <div class="card-body pb-0">
        <h5 class="card-title">Top Selling <span>| 
        <?php 

        switch ($filter) {
            case 'today':
                echo "Today";
                break;
            case 'this_month':
                echo "This Month";
                break;
            case 'this_year':
                echo "This Year";
                break;
            default:
                echo "Today";
        }

        ?>
        </span></h5>

        <table class="table table-borderless">
        <thead>
            <tr>
            <th scope="col">Preview</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Sold</th>
            <th scope="col">Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datanow as $item) {?>
            <tr>
            <th scope="row"><img src="<?php echo $item['Image']  ?>" alt="<?php echo $item['Name']  ?>"></th>
            <td><?php echo $item['Name']  ?></td>
            <td><?php echo $formatted_quantity = number_format($item['Price'], 0, '', ',');?> VND</td>
            <td class="fw-bold"><?php echo $item['QuantitySold']  ?></td>
            <td><?php echo $formatted_quantity = number_format($item['Revenue'], 0, '', ',');?> VND</td>
            </tr>
            <tr></tr>
            <?php } ?>
        </tbody>
        </table>

    </div>

    </div>
</div>