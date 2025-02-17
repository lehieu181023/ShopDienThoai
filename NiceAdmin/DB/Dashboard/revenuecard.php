<?php
    include('../DBcontext.php');
    $filter = $_GET['filter'] ?? 'today';

    $query = "SELECT 
                SUM(pio.quantity) AS total_quantity, 
                SUM(o.total) AS total_sales
            FROM `order` o 
            JOIN product_in_order pio ON pio.idorder = o.id";
    $query1 = "";
    
    if ($filter == "today") {
        $query1 = $query . " WHERE DATE(o.DayCreate) = CURDATE() - INTERVAL 1 DAY";
        $query .= " WHERE DATE(DayCreate) = CURDATE()";
        
    } elseif ($filter == "this_month") {
        $query1 = $query . " WHERE o.DayCreate >= DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m-01') 
                            AND o.DayCreate < DATE_FORMAT(CURDATE(), '%Y-%m-01');";
        $query .= " WHERE MONTH(DayCreate) = MONTH(CURDATE()) AND YEAR(DayCreate) = YEAR(CURDATE())";
    } elseif ($filter == "this_year") {
        $query1 = $query . " WHERE YEAR(o.DayCreate) = YEAR(CURDATE()) - INTERVAL 1 YEAR;";
        $query .= " WHERE YEAR(DayCreate) = YEAR(CURDATE())";
    }

    $datanow = $db->OneSelect($query);
    $dataago = $db->OneSelect($query1);

    $totalnow = $datanow['total_sales']??0;
    $totalago = $dataago['total_sales']??0;
    $revenue_increase = ($totalago == $totalnow)?0:(($totalago == 0)?100: round(($totalnow - $totalago) / $totalago * 100, 2));
    $formatted = number_format($totalnow, 0, '', ',');
?>
<div class="card info-card revenue-card">

    <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
        <h6>Filter</h6>
        </li>

        <li><a class="dropdown-item" onclick="revenuecard('today')">Today</a></li>
        <li><a class="dropdown-item" onclick="revenuecard('this_month')">This Month</a></li>
        <li><a class="dropdown-item" onclick="revenuecard('this_year')">This Year</a></li>
    </ul>
    </div>

    <div class="card-body">
    <h5 class="card-title">Revenue <span>| 
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

    <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
        <i class="bi bi-currency-dollar"></i>
        </div>
        <div class="ps-3">
        <h6><?php echo $formatted ?> VND</h6>
        <span class="text-success small pt-1 fw-bold"><?php echo $revenue_increase ?>%</span> <span class="text-muted small pt-2 ps-1">increase</span>

        </div>
    </div>
    </div>

</div>