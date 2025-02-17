<?php
    include ('../DBcontext.php');
    $filter = $_GET['filter'] ?? 'today';

    $query = "SELECT COUNT(*) as COUNTCustomer FROM `accountcustomer` WHERE access = 'customer'";
    $query1 = "";
    
    if ($filter == "today") {
        $query1 = $query . " AND DATE(CreateDay) = CURDATE() - INTERVAL 1 DAY;";
        $query .= " AND DATE(CreateDay) = CURDATE()";
        
    } elseif ($filter == "this_month") {
        $query1 = $query . " AND CreateDay >= DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m-01') 
                            AND CreateDay < DATE_FORMAT(CURDATE(), '%Y-%m-01');";
        $query .= " AND MONTH(CreateDay) = MONTH(CURDATE()) AND YEAR(CreateDay) = YEAR(CURDATE())";
    } elseif ($filter == "this_year") {
        $query1 = $query . " AND YEAR(CreateDay) = YEAR(CURDATE()) - INTERVAL 1 YEAR;";
        $query .= " AND YEAR(CreateDay) = YEAR(CURDATE())";
    }
    $datanow = $db->OneSelect($query);
    $dataago = $db->OneSelect($query1);

    $customernow = $datanow['COUNTCustomer'];
    $customerago = $dataago['COUNTCustomer'];
    $customer_increase = ($customerago == $customernow)?0:(($customerago == 0)?100: round(($customernow - $customerago) / $customerago * 100, 2));
    $formatted_customer = number_format($customernow, 0, '', ',');
?>
<div class="card info-card customers-card">
    <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
        <li class="dropdown-header text-start">
        <h6>Filter</h6>
        </li>

        <li><a class="dropdown-item" onclick="customercard('today')">Today</a></li>
        <li><a class="dropdown-item" onclick="customercard('this_month')">This Month</a></li>
        <li><a class="dropdown-item" onclick="customercard('this_year')">This Year</a></li>
    </ul>
    </div>

    <div class="card-body">
    <h5 class="card-title">Customers <span>| 
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
        <i class="bi bi-people"></i>
        </div>
        <div class="ps-3">
        <h6><?php echo $formatted_customer ?></h6>
        <span class="text-danger small pt-1 fw-bold"><?php echo $customer_increase ?>%</span> <span class="text-muted small pt-2 ps-1">decrease</span>

        </div>
    </div>

    </div>
</div>